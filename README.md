@author email : birender.rana18@outlook.com
@author name  : Birender Singh Rana


/----------------------- Sample Core PHP Rounting Project ----------------------------------/

<b><u><i>Folder Structure</i></u></b>

/assets
	--css [ Storing CSS Files ]
	--fonts [ Storing Fonts Files ]
	--js [ Storing JS Files ]
	--images [ Storing Static Images Files Like [ Banner/Logo etc... ]
	--uploads [ Storing Uploaded Images ]

/cache [ Storing Cache File ]
	1 Before Calling Output File on Controller $this->cache(1);
	2 After Calling Output File on Controller $this->cache(2);
	
/controller [ Storing Controller Created By User ]

/db [ Storing Model Created By User ]

/helper [ Storing User Helper Files ]

/library [ Storing User Library Created By User ]

/system [ Storing Project Configuration Files
	--error_log [ Storing Project Error Log [ To Enabled Error Log // Uncomment set_error_handler("error_handler"); on Config.php
	Files : 
	-config.php [ Project Configuration Files ]
	-dbconnection.php [ Create Database Connection ]
	-MysqliDB.php [ MYSQL Library ]
	-require.php [ Load All Helpers and Library File into Project ]
	-uri.php [ For Routing Purpose ]
	-cache_start.php [ Cache Generating Files ]
	-cache_end.php [ Cache Generating Files ]

/views [ Storing User Templates Files ]

-- .htaccess
-- router.php
-- routers.php
-- readme.md
