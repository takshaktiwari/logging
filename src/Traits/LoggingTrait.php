<?php

namespace Takshak\Logging\Traits;
use Takshak\Logging\Models\Logging;
use Str;
use Auth;
use Storage;

trait LoggingTrait
{
    public function logActivity($driver='file')
    {
    	if ($driver == 'database') {
    		$this->writeToDatabse();
    	}else{
    		$this->writeToFile();
    	}

    }

    public function writeToDatabse()
    {
    	return Logging::create([
    	    'method'    =>  request()->method(),
    	    'url'       =>  request()->path(),
    	    'data'      =>  request()->all(),
    	    'remarks'   =>  null,
    	    'user_id'   =>  Auth::id(),
    	    'user_ip'   =>  request()->ip(),
    	    'user'      =>  Auth::user()
    	]);
    }

    public function writeToFile()
    {
    	$fileName = 'logs/user-log-';
    	$fileName .= Str::of(now()->format('d-M-Y'))->slug('-');
    	$fileName .= '.log';
    	if (!Storage::exists($fileName)) {
    	    Storage::put($fileName, '');
    	}

    	$content = '['.now()->format('d-M-Y H:i:s').']';
    	$content .= '    ';
    	$content .= request()->method();
    	$content .= '    ';
    	$content .= request()->path();
    	$content .= '    ';
        
    	$content .= '[';
    	$content .= implode(', ', $this->userData());
    	$content .= ']';
    	$content .= '    ';

    	$content .= '[';
    	$content .= implode(' | ', $this->requestData());
    	$content .= ']';
    	
    	Storage::append($fileName, $content);
    	return $content;
    }

    public function userData()
    {
        $user = [];
        $user[] = request()->ip();
        if(Auth::check()){
            foreach(request()->user()->toArray() as $key => $value){
                if (in_array($key, ['id', 'name', 'email', 'mobile', 'phone'])) {
                    $user[] = $value;
                }
            }
        }

        return $user;
    }

    public function requestData($value='')
    {
        $data = [];
        foreach(request()->all() as $key => $value){
            $item = $key.': ';
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            $item .= $value;
            
            $data[] = $item;
        }

        return $data;
    }

}