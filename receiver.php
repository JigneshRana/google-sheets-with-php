<?php
class logger{
    public function logIt($str){
        global $logsPath;
        $logsPath =__DIR__.'/logs/';
        $logfilename = 'default_'.date('Ymd').'.log';
        
        if(file_exists($logsPath.$logfilename))
        {
                if(filesize($logsPath.$logfilename)>20000000)
                {
                        rename($logsPath.$logfilename,$logsPath.date('Ymd_His').$logfilename);
                }
        }
        $sname = "";
        if(isset($_SERVER['SERVER_NAME'])){
            $sname = $_SERVER['SERVER_NAME'];
        }else{
            if (php_sapi_name() == 'cli') {
                $sname = "CLI";
            }
            
        }

        $finalLogData = $this->VisitorIP().",".$sname.",".date("Y-m-d H:i:s").",".$str;
        $fp = fopen($logsPath.$logfilename, 'a');
        fwrite($fp, $finalLogData."\n");
        fclose($fp);
    
    }

    public function VisitorIP()
        { 
                if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                        $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else {
                    if(isset($_SERVER['REMOTE_ADDR'])){
                        $TheIp=$_SERVER['REMOTE_ADDR'];
                    }
                    else{
                        $TheIp="LocalServer"; 
                    }
                }

                $iparr = explode(',',$TheIp);
                
                if(count($iparr)>0)
                {
                        $TheIp=trim($iparr[0]);
                }
                
                return trim($TheIp);
        }
}

$json = file_get_contents('php://input');
$data = json_decode($json);
$log = new logger();
$log->logIt($data);

?>