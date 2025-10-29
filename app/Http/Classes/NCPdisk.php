<?php
namespace App\Http\Classes; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Image;

if( !class_exists("NCPdisk") ) {

    CLASS NCPdisk{

	    function __construct(){
        }

        function upload($path, $file) {
			
			$data = [];

			$this->path = $path;
			$this->file = $file;

			$fileRealName = $this->file->getClientOriginalName();
			$fileExtension = $this->file->getClientOriginalExtension();        
			$tempFileName = Str::uuid()->toString().".".$fileExtension;

			$file_contents = file_get_contents($this->file);
			$save_filename = $this->path."/".$tempFileName;
	
			$res = Storage::disk('ncloud')->put($save_filename,$file_contents);

			if( $res ) {
				$data['result'] = true;
				$data['realfile'] = $fileRealName;
				$data['filename'] = $tempFileName;
				$data['filepath'] = $save_filename;
			} else {
				$data['result'] = false;
			}

			return $data;
        }

        function url($filepath, $time = "") {
			if( $time == "" ) $time = now()->addMinutes(5);
			return Storage::disk('ncloud')->temporaryUrl($filepath,$time);
        }

    }

} // end class exist
?>