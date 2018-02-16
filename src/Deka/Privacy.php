<?php

class Deka_Privacy
{
    protected static $lifetime=43200;
    protected static $dls_server='http://dlserv.t3lead.com';

    public static function get($title)
    {
        $server = $_SERVER['HTTP_HOST'];
        $url = self::$dls_server . '/privacy/index/product/' .$title . '/?ref='. $server;
        $title = htmlspecialchars($title);
        $out = self::getCache($title);
        if(!$out) {
            $out = @file_get_contents($url);
            self::setCache($out,$title);
        }
        return $out;
    }

    protected static function getCache($title){
        global $wpdb;
        $cache_table_name = $wpdb->prefix . 'deka_cache';
        $row = $wpdb->get_row( "SELECT * FROM ".$cache_table_name." WHERE title = '".$title."'" );
        if($row && isset($row->title) && isset($row->content) && $row->content && strtotime($row->date_expire)>time() ){
            return $row->content;
        }
        return false;
    }

    protected static function setCache($out,$title){
        global $wpdb;
        $cache_table_name = $wpdb->prefix . 'deka_cache';
        $wpdb->replace(
            $cache_table_name,
            array(
                'content' => $out,
                'title' => $title,
                'date_expire' => date("Y-m-d H:i:s", (time()+self::$lifetime))
            )
        );
        //echo "Last SQL-Query: ".$wpdb->last_query;
    }

    public static function emptyCache(){
        global $wpdb;
        $table  = $wpdb->prefix . 'deka_cache';
        $delete = $wpdb->query("TRUNCATE TABLE $table");
        return $delete;
    }

}