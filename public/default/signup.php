<!DOCTYPE html>
<tpl:layout xmlns="http://www.w3.org/1999/xhtml" xmlns:tpl="http://budkit.org/tpl">
    <html class="no-js" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title><tpl:element type="text" data="page.title">Create New Account</tpl:element></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="description" content="${page.description}" />
            <meta name="author" content="${page.author}" />
            <meta name="keywords" content="${page.author}" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <!-- Le styles -->
            <link href="/${config|design.template}/assets/css/bootstrap.css" rel="stylesheet" />
            <link href="/${config|design.template}/assets/css/bootstrap-responsive.css" rel="stylesheet" />
            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="/${config|design.template}/assets/js/html5shiv.js"></script>
            <![endif]-->
            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/${config|design.template}/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/${config|design.template}/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/${config|design.template}/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="/${config|design.template}/assets/ico/apple-touch-icon-57-precomposed.png" />
            <link rel="shortcut icon" href="/${config|design.template}/assets/ico/favicon.png" />
            <tpl:utility type="head" />
        </head>
        <body>
            <div id="wrap">                
                <div class="container-box">
                    <div class="container-right">
                        <div class="container-content scroll-y">
                            <div class="container-fluid">
                                <div class="container-startup signup">
                                    <form class="form-vertical" name="form" method="post" action="/sign-up">
                                        <!--                                        <div class="startup-header">
                                                                                    <h3>Register a new account</h3>
                                                                                </div>-->
                                        <tpl:block data="page.block.alerts" />
                                        <div class="startup-alternatives">
                                            <ul class="unstyled no-margin no-bottom-margin">
                                                <li><a href="/system/authenticate/login">Already have an account? Sign-in</a></li>
                                            </ul>
                                        </div>                                      
                                        <div class="startup-body">
                                            <tpl:condition test="boolean" data="config|general.site-allow-registration" value="1">
                                                <tpl:condition test="boolean" data="config|general.site-inviteonly" value="0">
                                                    <div class="row-fluid">
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="user_first_name"><tpl:i18n>First Name</tpl:i18n><em class="mandatory">*</em></label>
                                                            <div class="controls">
                                                                <input class="span12 focused" id="first_name" name="user_first_name" type="text" placeholder="First Name" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="user_last_name"><tpl:i18n>Last Name</tpl:i18n><em class="mandatory">*</em></label>
                                                            <div class="controls">
                                                                <input class="span12 focused" id="last_name" name="user_last_name" type="text" placeholder="Last Name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group row-fluid">
                                                        <label class="control-label" for="user_email"><tpl:i18n>Email address</tpl:i18n><em class="mandatory">*</em></label>
                                                        <div class="controls">
                                                            <input class="span12 focused" id="user_email" name="user_email" type="text" placeholder="<?php echo _('e.g john.doe@example.com'); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="user_name_id"><tpl:i18n>Unique Username</tpl:i18n><em class="mandatory">*</em></label>
                                                            <div class="controls">
                                                                <input class="span12 focused" id="user_name_id" name="user_name_id" type="text" placeholder="JohnDoe1976" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group span6">
                                                            <label class="control-label" >Date of Birth</label>
                                                            <div class="controls inline-inputs">
                                                                <select name="user_dob_day" id="dob-day">
                                                                    <option>Day</option>
                                                                    <option value="01">01</option>
                                                                    <option value="02">02</option>
                                                                    <option value="03">03</option>
                                                                    <option value="04">04</option>
                                                                    <option value="05">05</option>
                                                                    <option value="06">06</option>
                                                                    <option value="07">07</option>
                                                                    <option value="08">08</option>
                                                                    <option value="09">09</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="17">17</option>
                                                                    <option value="18">18</option>
                                                                    <option value="19">19</option>
                                                                    <option value="20">20</option>
                                                                    <option value="21">21</option>
                                                                    <option value="22">22</option>
                                                                    <option value="23">23</option>
                                                                    <option value="24">24</option>
                                                                    <option value="25">25</option>
                                                                    <option value="26">26</option>
                                                                    <option value="27">27</option>
                                                                    <option value="28">28</option>
                                                                    <option value="29">29</option>
                                                                    <option value="30">30</option>
                                                                    <option value="31">31</option>
                                                                </select>
                                                                <select name="user_dob_month" id="dob-month" >
                                                                    <option>- Month -</option>
                                                                    <option value="01">January</option>
                                                                    <option value="02">February</option>
                                                                    <option value="03">March</option>
                                                                    <option value="04">April</option>
                                                                    <option value="05">May</option>
                                                                    <option value="06">June</option>
                                                                    <option value="07">July</option>
                                                                    <option value="08">August</option>
                                                                    <option value="09">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                </select>
                                                                <select name="user_dob_year" id="dob-year" class="inline drop">
                                                                    <option>- Year -</option>
                                                                    <option value="2011">2011</option>
                                                                    <option value="2010">2010</option>
                                                                    <option value="2009">2009</option>
                                                                    <option value="2008">2008</option>
                                                                    <option value="2007">2007</option>
                                                                    <option value="2006">2006</option>
                                                                    <option value="2005">2005</option>
                                                                    <option value="2004">2004</option>
                                                                    <option value="2003">2003</option>
                                                                    <option value="2002">2002</option>
                                                                    <option value="2001">2001</option>
                                                                    <option value="2000">2000</option>
                                                                    <option value="1999">1999</option>
                                                                    <option value="1998">1998</option>
                                                                    <option value="1997">1997</option>
                                                                    <option value="1996">1996</option>
                                                                    <option value="1995">1995</option>
                                                                    <option value="1994">1994</option>
                                                                    <option value="1993">1993</option>
                                                                    <option value="1992">1992</option>
                                                                    <option value="1991">1991</option>
                                                                    <option value="1990">1990</option>
                                                                    <option value="1989">1989</option>
                                                                    <option value="1988">1988</option>
                                                                    <option value="1987">1987</option>
                                                                    <option value="1986">1986</option>
                                                                    <option value="1985">1985</option>
                                                                    <option value="1984">1984</option>
                                                                    <option value="1983">1983</option>
                                                                    <option value="1982">1982</option>
                                                                    <option value="1981">1981</option>
                                                                    <option value="1980">1980</option>
                                                                    <option value="1979">1979</option>
                                                                    <option value="1978">1978</option>
                                                                    <option value="1977">1977</option>
                                                                    <option value="1976">1976</option>
                                                                    <option value="1975">1975</option>
                                                                    <option value="1974">1974</option>
                                                                    <option value="1973">1973</option>
                                                                    <option value="1972">1972</option>
                                                                    <option value="1971">1971</option>
                                                                    <option value="1970">1970</option>
                                                                    <option value="1969">1969</option>
                                                                    <option value="1968">1968</option>
                                                                    <option value="1967">1967</option>
                                                                    <option value="1966">1966</option>
                                                                    <option value="1965">1965</option>
                                                                    <option value="1964">1964</option>
                                                                    <option value="1963">1963</option>
                                                                    <option value="1962">1962</option>
                                                                    <option value="1961">1961</option>
                                                                    <option value="1960">1960</option>
                                                                    <option value="1959">1959</option>
                                                                    <option value="1958">1958</option>
                                                                    <option value="1957">1957</option>
                                                                    <option value="1956">1956</option>
                                                                    <option value="1955">1955</option>
                                                                    <option value="1954">1954</option>
                                                                    <option value="1953">1953</option>
                                                                    <option value="1952">1952</option>
                                                                    <option value="1951">1951</option>
                                                                    <option value="1950">1950</option>
                                                                    <option value="1949">1949</option>
                                                                    <option value="1948">1948</option>
                                                                    <option value="1947">1947</option>
                                                                    <option value="1946">1946</option>
                                                                    <option value="1945">1945</option>
                                                                    <option value="1944">1944</option>
                                                                    <option value="1943">1943</option>
                                                                    <option value="1942">1942</option>
                                                                    <option value="1941">1941</option>
                                                                    <option value="1940">1940</option>
                                                                    <option value="1939">1939</option>
                                                                    <option value="1938">1938</option>
                                                                    <option value="1937">1937</option>
                                                                    <option value="1936">1936</option>
                                                                    <option value="1935">1935</option>
                                                                    <option value="1934">1934</option>
                                                                    <option value="1933">1933</option>
                                                                    <option value="1932">1932</option>
                                                                    <option value="1931">1931</option>
                                                                    <option value="1930">1930</option>
                                                                    <option value="1929">1929</option>
                                                                    <option value="1928">1928</option>
                                                                    <option value="1927">1927</option>
                                                                    <option value="1926">1926</option>
                                                                    <option value="1925">1925</option>
                                                                    <option value="1924">1924</option>
                                                                    <option value="1923">1923</option>
                                                                    <option value="1922">1922</option>
                                                                    <option value="1921">1921</option>
                                                                    <option value="1920">1920</option>
                                                                    <option value="1919">1919</option>
                                                                    <option value="1918">1918</option>
                                                                    <option value="1917">1917</option>
                                                                    <option value="1916">1916</option>
                                                                    <option value="1915">1915</option>
                                                                    <option value="1914">1914</option>
                                                                    <option value="1913">1913</option>
                                                                    <option value="1912">1912</option>
                                                                    <option value="1911">1911</option>
                                                                    <option value="1910">1910</option>
                                                                    <option value="1909">1909</option>
                                                                    <option value="1908">1908</option>
                                                                    <option value="1907">1907</option>
                                                                    <option value="1906">1906</option>
                                                                    <option value="1905">1905</option>
                                                                    <option value="1904">1904</option>
                                                                    <option value="1903">1903</option>
                                                                    <option value="1902">1902</option>
                                                                    <option value="1901">1901</option>
                                                                    <option value="1900">1900</option>
                                                                </select>
                                                            </div>
                                                        </div><!-- /control-group -->
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="user_password"><tpl:i18n>Password</tpl:i18n><em class="mandatory">*</em></label>
                                                            <div class="controls">
                                                                <input class="span12 focused" id="user_password" name="user_password" type="password" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="user_password_2"><tpl:i18n>Verify Password</tpl:i18n><em class="mandatory">*</em></label>
                                                            <div class="controls">
                                                                <input class="span12 focused" id="user_password_2" name="user_password_2" type="password" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tpl:condition>
                                                <tpl:condition test="boolean" data="config|general.site-inviteonly" value="1">
                                                    <div class="control-group">
                                                        <label class="control-label" for="user_invite_code">Invite Code<em class="mandatory">*</em></label>
                                                        <div class="controls">
                                                            <input class="input-xlarge focused" id="user_invite_code" name="user_invite_code" type="text" />
                                                            <span class="help-block">Please enter a valid invite code</span>
                                                        </div>
                                                    </div>
                                                </tpl:condition>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="user_accepted_terms" value="1" />
                                                            You agree to our <a href="#">terms and conditions</a>
                                                        </label>
                                                        <input type="hidden" name="user_accepted_terms_2" value="2" />                                                      
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn">Create an Account</button> 
                                                    </div>
                                                </div> 
                                            </tpl:condition>
                                            <tpl:condition test="boolean" data="config|general.site-allow-registration" value="0">
                                                <div class="alert alert-info">We are currently not accepting any new user registration at this time. Please try again later</div>
                                            </tpl:condition>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.fluid-container-->
            </div>
            <!-- Le javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="/${config|design.template}/assets/js/jquery.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-transition.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-alert.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-modal.js"></script>
            <script src="/${config|design.template}/assets/js/budkit-container.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-dropdown.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-scrollspy.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tab.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-tooltip.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-popover.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-button.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-collapse.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-carousel.js"></script>
            <script src="/${config|design.template}/assets/js/bootstrap-typeahead.js"></script>
        </body>
    </html>
</tpl:layout>

