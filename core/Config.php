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
                $config->setDbEnvironment();
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
    
    private function setDbEnvironment(){
	    $host = trim(parse_url($_SERVER['HTTP_HOST'],PHP_URL_HOST),'/');
	    $dbEnvironment = (in_array($host,['localhost','127.0.0.1','::1']))
		    ? 'database_test'
		    : 'database_live';
	    $this->config['database_environment'] = $dbEnvironment;
    }
	
	public function getDbEnvironment()
	{
		return $this->config['database_environment'];
    }
}