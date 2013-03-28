BudKit
======

BudKit (BK) is a free open-source platform for building applications for social and professional networking. BK is about people, the things they do, love and share at the places they go. Budkit requires a database to run and supports multiple DBMS including MySQL, PostgreSQL and SQLite3. It is built using the hierarchical Model-View-Controller approach which separates presentation of information from the users interaction with that information. BK is not just another social networking app.

The BK project culminates from years of frustration at the inability to find a FREE, non bloated and complete social networking solution for individuals and institutions, allowing for subgroup management of social data, hence eliminating the increasing privacy quagmires plaguing other large social networking solutions.

Privacy is a concern. A distributed network empowers your user to their own data and access thereof.  BK aims to fill the requirement for a distributed networking platform allowing for decentralized social content yet still allowing for robust communication between nodes, such that a a member on a private localized network such as a family social network powered by BK can very easily ‘leap’ unto another network e.g. a school or other institution. There in lies the future of social networking.

I. Requirements
-----------------
NOTE: Whilst several other web apps compromise performance in order to attain wider usability, we believe that a forward web is one employing the latest and the best technology available to guarantee performance. Whilst we have not tested BK on a shared host or other restrictive environment, the requirements listed here are the lowest common denominator for the required performance. 


### Apache 2+
[APACHE2]: https://httpd.apache.org/docs/2.4/
We have not tested BK on anything other than [Apache2][APACHE2]. So expect the unexpected with any diversions

### PHP 5.4+
[PHP5]: http://php.net/releases/5_4_0.php
You will need a version of the [PHP 5.4.0][PHP5] or higher installed. 

The following PHP extensions are required
    gd - Image Manipultation
    mcrypt - Cryptography Handling	
    gettext - Localization
    tokenizer - Tokenizer
    pcre - Perl Compatible RegEx
    json - javaScript Object Notation
    iconv - IconV Character-Set Conversion
    imap - IMAP extension
    mbstring - Multibyte Strings
    ctype - Character-Type checking
    libxml - XML Manipulation
    zlib - Zlib Compression

The following PHP directives are required
    safe_mode -	Off		
    display_errors -	Off		
    magic_quotes_sybase -	Off	
    magic_quotes_gpc -	Off	
    magic_quotes_runtime - Off	
    session.auto_start -	Off	
    output_buffering -	On	
    register_globals -	Off	
    file_uploads -	On
    upload_max_filesize	> 200M (for uploading large files e.g videos)

### MySQL 5.5+
[MySQL55]: http://dev.mysql.com/tech-resources/articles/introduction-to-mysql-55.html
BK  users a nifty entity attribute value data model. If you intend to use MySQL as your data store the minimum required version is [MySQL 5.5+][MySQL55] or higher. 	

II. Demo
---------
As of yet there is no hosted demo. We encourage you to download and try BK by installing on your local machine. For developers seeking a new adventures take a look at the resources section for tools to get you started

III. Credits and Acknowledgments
--------------------------------



IV. Resources
--------------------------------
[Budkit Blog](http://budkit.org/blog)

[Budkit API](http://drstonyhills.github.com/budkit)