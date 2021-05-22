<?php

$memcache = new Memcache;
 $memcache->connect("127.0.0.1",11211); # You might need to set "localhost" to "127.0.0.1"
 echo "Server's version: " . $memcache->getVersion() . "<br />\n";
 $tmp_object = new stdClass;
 $tmp_object->str_attr = "test";
 $tmp_object->int_attr = 123;
 $memcache->set("key",$tmp_object,false,10);
 echo "Store data in the cache (data will expire in 10 seconds)<br />\n";
 echo "Data from the cache:<br />\n";
 var_dump($memcache->get("key"));

?>