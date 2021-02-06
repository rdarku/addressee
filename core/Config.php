<?php


namespace App\Core;


class Config
{
    protected array $config = [];

    public static function load($file)
    {
        $config = new static();

        try {
            if( is_file(  $file ) ) {
                $config->config = parse_ini_file($file,TRUE);
            }
            else{
                throw new \Exception( $file . ' not found.' );
            }
        }
        catch (\Exception $e){
            throw new \Exception( $e->getMessage()  );
        }

        return $config;
    }

    public function getConfig(){
        return($this->config);
    }
}