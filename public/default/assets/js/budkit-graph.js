/* ===================================================
 * budkit-graph.js v0.0.1
 * http://budkit.org/kb/graph
 * ===================================================
 * This class is loosely based on Jim Vallandingham network visualization
 * tutorial with d3 
 * http://flowingdata.com/2012/08/02/how-to-make-an-interactive-network-visualization/
 * 
 * Copyright 2012 The BudKit Team
 *
 * This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */
!function($) {
    "use strict"
    var BKGraph = function(placeholder, data, options) {
        
        this.options = $.extend({}, $.fn.bkgraph.defaults, options);
       
        this.curEdgesData = [];
        this.curNodesData = [];
        this.edgesByIndex = {};

        this.node = null;
        this.edge = null;
        
        this.force = d3.layout.force();
        this.nodeColors = d3.scale.category20();
        this.graph = d3.select(placeholder).append("svg").attr("width", this.options.width).attr("height", this.options.height);
        
                
        //@TODO might need to add a tooltip and hover layer;
        this.patternsLayer = this.graph.append('svg:defs');
        this.edgesLayer = this.graph.append("g").attr("id", "edges");
        this.nodesLayer = this.graph.append("g").attr("id", "nodes");
        
        this.data  = this.init(data); 
                
        this.force.size([this.options.width, this.options.height]);
        this.setLayout("force");
        this.draw()
    };
    //Graph Class
    BKGraph.prototype = {
        init : function(data) {
            var circleRadius, countExtent, nodesMap, self = this;
            countExtent = d3.extent(data.nodes, function(d) {
                return d.playcount;
            });
            circleRadius = d3.scale.sqrt().range([3, 12]).domain(countExtent);
            data.nodes.forEach(function(n) {
                n.x = Math.floor(Math.random() * self.options.width);
                n.y = Math.floor(Math.random() * self.options.height);
                
                //If there is an image, append to pattern;
                 self.patternsLayer.append('svg:pattern')
                .attr('id', 'imgPttrn'+n.id)
                .attr('patternUnits', 'userSpaceOnUse')
                .attr('width', '50')
                .attr('height', '50')
                .append('svg:image')
                .attr('xlink:href', 'http://social.budkit.org/system/object/WS1g7I/resize/80/80')
                .attr('x', 0)
                .attr('y', 0)
                .attr('width', 50)
                .attr('height', 50);
                //n.f = 'url(#imgPttrn'+n.id+')';
                return n.radius = 30;//circleRadius(n.playcount);
            });
            nodesMap = this.mapNodes(data.nodes);
            data.edges.forEach(function(l) {
                l.source = nodesMap.get(l.source);
                l.target = nodesMap.get(l.target);
                //console.log(self);
                return self.edgesByIndex["" + l.source.id + "," + l.target.id] = 1;
            });
            return data;
        },
        draw : function() {
            this.curNodesData = this.data.nodes;
            this.curEdgesData = this.data.edges;
 
            this.force.nodes(this.curNodesData);
            this.updateNodes();
            if (this.options.layout === "force") {
                this.force.links(this.curEdgesData);
                this.updateEdges();
            } else {
                this.force.links([]);
                if (this.edge) {
                    this.edge.data([]).exit().remove();
                    this.edge = null;
                }
            }
            return this.force.start();
        },
        setLayout : function(newLayout){
            var layout = this.options.layout = newLayout;

            return this.force.on("tick", this.forceTick).charge(-200).linkDistance(50);
        },
        forceTick : function(e) {
            $(this.node).attr("cx", function(d) {
                return d.x;
            }).attr("cy", function(d) {
                return d.y;
            });
            return $(this.edge).attr("x1", function(d) {
                return d.source.x;
            }).attr("y1", function(d) {
                return d.source.y;
            }).attr("x2", function(d) {
                return d.target.x;
            }).attr("y2", function(d) {
                return d.target.y;
            });
        },
        updateNodes: function() {
            var self = this;
            this.node = this.nodesLayer.selectAll("circle.node").data(this.curNodesData, function(d) {
                return d.id;
            });
            this.node.enter().append("circle").attr("class", "node").attr("cx", function(d) {
                return d.x;
            }).attr("cy", function(d) {
                return d.y;
            }).attr("r", function(d) {
                return d.radius;
            }).style("fill", function(d) {
                return (d.f)? d.f : self.nodeColors(d.id);
            }).style("stroke", function(d) {
                return self.strokeFor(d);
            }).style("stroke-width", 1.0);
            this.node.on("mouseover", this.showDetails).on("mouseout", this.hideDetails);
            return this.node.exit().remove();
        },   
        showDetails:function(d,i){
            
            return d3.select(this).style("stroke", "black").style("stroke-width", 2.0);
        },
        hideDetails:function(d,i){
             return d3.select(this).style("stroke", "black").style("stroke-width", 0.8);
        },
        strokeFor : function(d) {
            return d3.rgb(this.nodeColors(d.id)).darker().toString();
        },
        charge: function(node) {
            return -Math.pow(node.radius, 2.0) / 2;
        },
        updateEdges : function() {
            this.edge = this.edgesLayer.selectAll("line.link").data(this.curEdgesData, function(d) {
                return "" + d.source.id + "_" + d.target.id;
            });
            this.edge.enter().append("line").attr("class", "link").attr("stroke", "#ddd").attr("stroke-opacity", 0.8).attr("x1", function(d) {
                return d.source.x;
            }).attr("y1", function(d) {
                return d.source.y;
            }).attr("x2", function(d) {
                return d.target.x;
            }).attr("y2", function(d) {
                return d.target.y;
            });
            return this.edge.exit().remove();
        }, 
        mapNodes : function(nodes) {
            var nodesMap;
            nodesMap = d3.map();
            nodes.forEach(function(n) {
                return nodesMap.set(n.id, n);
            });
            return nodesMap;
        },
        nodeCounts : function(nodes, attr) {
            var counts;
            counts = {};
            nodes.forEach(function(d) {
                var _name, _ref;
                if ((_ref = counts[_name = d[attr]]) == null) {
                    counts[_name] = 0;
                }
                return counts[d[attr]] += 1;
            });
            return counts;
        },
        neighboring: function(a, b) {
            return this.edgesByIndex[a.id + "," + b.id] || this.edgesByIndex[b.id + "," + a.id];
        }
    };
    //Plugin Defintion
    $.fn.bkgraph = function(data, option) {
        return this.each(function() {
            var $this = $(this)
            , options = typeof option == 'object' && option;
            //I probably should not be doing this but hey?
            $this.data('bkgraph', (new BKGraph(this, data, options)))
        });
    };
    $.fn.bkgraph.defaults = {
        width:500,
        height:500
    };
    $.fn.bkgraph.Constructor = BKGraph;
    /* GRAPH DATA-API
     * ============== */
    $(function() {
        $('[data-graph]').bkgraph({
            "nodes": [
            {
                "id": "one",      "match": 0.147889,
      "name": "Heart of Glass",
      "artist": "Blondie",
      "playcount": 2174351
            },
            {
                "id": "two",      "match": 0.147889,
      "name": "Heart of Glass",
      "artist": "Blondie",
      "playcount": 2174351
            },
            {
                "id": "three",      "match": 0.147889,
      "name": "Heart of Glass",
      "artist": "Blondie",
      "playcount": 2174351
            },
            {
                "id": "four",      "match": 0.147889,
      "name": "Heart of Glass",
      "artist": "Blondie",
      "playcount": 2174351
            }
            ],
            "edges": [
            {
                "source": "one",
                "target": "two"
            },
            {
                "source": "two",
                "target": "four"
            },
            {
                "source": "three",
                "target": "one"
            },
            {
                "source": "three",
                "target": "two"
            },
            {
                "source": "four",
                "target": "three"
            }
            ]
        }
        );
    })
}(window.jQuery);


