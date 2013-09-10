<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Folders{

    public function __construct()//$params)
    {
        $CI =& get_instance();
        $CI->load->library('image_lib');
//        $this->load->library('image_lib');
    }
    function trimCharacters($name)//changes name with spaces and replace it with -;
    {
        return strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9. s_-]/', '', trim($name))));
    }
    function checkDirectoryStatus($dirAddress)
    {
                //echo ' directory status';exit;
        if(file_exists($dirAddress)){
            $flag = false;//no same directory could be created so returned false.
            return $flag;

        }
        else {
            $flag = true;//green signal to create directory
           return $flag;
            //echo $flag;exit;
            //echo 'Given Directory Doesnot Exist';exit;
       }
    }
    function makeDirectory($dirName,$dirLocation="",$mode = 0777,$recursive=true)
    {
        $dirName = $this->trimCharacters($dirName);
        
        if($dirLocation==""){
            $pathname=  getcwd() .'/'. $dirName;
        }
        else {
            $pathname=  getcwd() .'/'.$dirLocation.'/'. $dirName;
        }
        
        $flag = $this->checkDirectoryStatus($pathname);
        if($flag != false){
            try{
                    mkdir($pathname, $mode, $recursive);
                    $data['flag']=$flag;
                    return $data;
            }catch(Exception $ex)
            {
                    print_r($ex);
            }
        }
        else 
        {
            $data['flag']=$flag;
            return $data;
        }
    }
    function isdirectoryOrFile($name){
        if(is_dir($name)){
            return 'dir';
        }
        else if(is_file($name)){
            return 'file';
        }
    }
    function displayDirectory($dirName=""){
        $dir = getcwd().'/'.$dirName;   //setting the current working directory or the directory set by user;        
        $dirExistOrNot = $this->checkDirectoryStatus($dir);
        $dirList = scandir($dir);
        $dirList = array_diff($dirList, array('..', '.')); //Removes . and .. values from the dirlist due to scandir();
        if(count($dirList)==0)
        {
            return array(0);//return null Array;
            exit;
        }
        $countD = 0;$countF =0;   //Counter set for Directories and files
        foreach($dirList as $item)
        {
            $dirOrFile = $this->isdirectoryOrFile($item);
            //
            if ($dirOrFile=='dir')
            {
                
                $fileNdir["Directories"][$countD] = array(
                        'type'=>'d',
                        'name'=>$item
                );
                $countD+=1; 
            }
            if ($dirOrFile=='file')
            {
                $fileNdir["Files"][$countF] = array(
                        'type'=>'f',
                        'name'=>$item
                );
                $countF+=1; 
            }
        }
        return $fileNdir; //returns Array with Directories And Files;  
    }
    function rename($oldName, $newName){ //for renaming file or directory
        $oldName=  getcwd().'/'.$oldName;
        $newName=  getcwd().'/'.$newName;
        $data = rename($oldName, $newName);
        print_r($data);
    }
  //=============================================================================================================>>>>
  ///////////////////////////////////////////////[ IMAGE UPLOADER ]//////////////////////////////////////////////////
  //=============================================================================================================>>>>
   public function imageManage($imageName="", $directory="images", $width=280, $height=280){
//        $width = array (
//                    3=>100, //3 for extra Large thumbnails
//                    2=>75, //2 for large
//                    1=>55, //1 for medium
//                    0=>45 //0 for small
//                );
//        $height = array (
//                    3=>100, //3 for extra Large thumbnails
//                    2=>75, //2 for large
//                    1=>55, //1 for medium
//                    0=>45 //0 for small
//                );
        $config['image_library'] = 'gd2';
        $config['source_image'] = getcwd().'/'.$directory.'/'.$imageName;
        $this->makeDirectory( 'thumbs', $directory);
        $config['create_thumb'] = TRUE;
        $config['thumb_marker'] = "";
        $config['maintain_ratio'] = TRUE;
        //CREATE LOOP FOR EACH WIDTH AND HEIGHT AND MAKE THE THUMBNAILS EVEN FOR 1
        //for($i=0; $i<count($width); $i++){
//            $this->makeDirectory($i, $directory.'/thumbs');
//            $config['new_image'] = getcwd().'/'.$directory.'/thumbs/'.$i.'/'.$imageName;
//            $config['width'] = $width[$i];
//            $config['height'] = $height[$i];
//            
//            $CI = & get_instance();
//             $CI->image_lib->initialize($config);
//            if(!($CI->image_lib->resize())){
//                echo $CI->image_lib->display_errors();
//            }
        //}
        
        
        
        
        $this->makeDirectory('thumbs', $directory);
        
        $config['new_image'] = getcwd().'/'.$directory.'/thumbs/'.$imageName;
        $config['width'] = $width;
        $config['height'] = $height;

        $CI = & get_instance();
        $CI->load->library('image_lib');
        $CI->image_lib->initialize($config);
        if(!($CI->image_lib->resize())){
            echo $CI->image_lib->display_errors();
        }
        $CI->image_lib->clear();
    }

    public function uploadFiles($files, $destinationFolder="uploadFolder", $createThumbs=FALSE, $maintainThumbsRatio=FALSE, $thumbWidth=FALSE, $thumbHeight=FALSE, $maxsize=4, $allowedTypesImg=array('image/jpeg', 'image/gif', 'image/bmp', 'image/png'))
    {
        $maximum=$maxsize*1024*1024;
        $noOfArrayName=0;
        foreach($files as $key => $val) {
            $arrayName = $key;
            $noOfArrayName++;
        }
        if(empty($arrayName)){
            $error =  'The way you have input the image is not valid.';
            throw new Exception($error);
            exit;
        }
        if(empty($destinationFolder)){
            $error = 'No any destination folder selected to create the files';
            throw new Exception($error);
            exit;
        }
        //CHECK DESTINATION EXIST OR NOT [THUMB DIRECTORY/UPLOAD DIRECTORY ]===================================>>>|DONE|
        
        $flag = $this->checkDirectoryStatus($destinationFolder);
        if($flag == true){
            $this->makeDirectory($destinationFolder);
        }
        if(count($files[$arrayName]['name'])>1) //Multiple file upload condition
        {
//            $j=0; //count_new_images
			$imageName=array();
            for ($i = 0; $i<count($files[$arrayName]['name']) ; $i++)  	 
            {
			//print_r($files);
                if(!empty($files[$arrayName]['name'][$i])){
                   
                if((in_array($files[$arrayName]['type'][$i], $allowedTypesImg)) && ($files[$arrayName]['size'][$i])<$maximum)
                    {
                        $upFolder = getcwd().'/'.$destinationFolder;
                       
                        $new_name[$i] = random_string('alnum', 4).'_'. $files[$arrayName]['name'][$i];
                        $new_name[$i] = $this->trimCharacters($new_name[$i]);
                        $uploaded[$i] = $new_name[$i];
                        $destination_file = $upFolder  .'/'. $new_name[$i];
                        try {
                            move_uploaded_file($files[$arrayName]['tmp_name'][$i], $destination_file);
//=======================================================================================================[ FOR THUMBNAILS ]
                           $this->imageManage($new_name[$i], $destinationFolder);
//=======================================================================================================[ FOR THUMBNAILS ]
//                            $path['orignal'][$i] = $destinationFolder.'/'.$new_name[$i];
//                            
//                            $path['thumbs'][$i]= $destinationFolder.'/thumbs/'.$new_name[$i];
                            $imageName[$i] = $new_name[$i];
//                            $j++;
                            
                        }
                        catch (Exception $ex){
                            print_r($ex);
                        }
                    }
                else{
                    $error = 'File "'.$files[$arrayName]['name'][$i].'" is not supported format or is over sized ['.$files[$arrayName]['size'][$i].' bytes]. Please upload again.';

                    //Rollback Code Here;=====================================================================>>>|DONE|
                    $this->rollback($uploaded, $i, $destinationFolder);
                    throw new Exception($error);
                }
              
                
            }   
                }//return $path;exit; //=========================>> for name with path
                return $imageName;
        }
        else if(count($files[$arrayName]['name'])==1 && !empty($files[$arrayName]['name'][0]))
        {
            
           try { // done IF CAN'T MOVE RAISE EXCEPTION 
                if((in_array($files[$arrayName]['type'], $allowedTypesImg)) || (in_array($files[$arrayName]['type'][0], $allowedTypesImg)))
                { 
//                    echo 'im in: '.$files[$arrayName]['type'][0];exit;
                    if(isset($files[$arrayName]['type'][0]) && strlen($files[$arrayName]['type'][0])>3){
                        $name = $files[$arrayName]['name'][0];
                        $temp_name=$files[$arrayName]['tmp_name'][0];
                    }else {
                        $name = $files[$arrayName]['name'];
                        $temp_name = $files[$arrayName]['tmp_name'];
                    }
                    $upFolder = getcwd().'/'.$destinationFolder;
                    $new_name = random_string('alnum', 4).'_'. $name;
                    $new_name = $this->trimCharacters($new_name);
                    $destination_file = $upFolder  .'/'. $new_name;
                    move_uploaded_file($temp_name,  $destination_file);
                    $this->imageManage($new_name, $destinationFolder);
                    //$path['orignal'][0] = $destinationFolder.'/'.$new_name; =================>>For name with path
                    //$path['thumbs'][0]= $destinationFolder.'/thumbs/'.$new_name; =================>>For name with path
                }
                else {
                    $error = 'Not valid file format. Please select a valid file format and try again.';
                    throw new Exception($error);
                    exit;
                }
            }
            catch (Exception $ex){
                print_r ($ex);
                exit;
            }
            $data=array(
                '0'=>$new_name
            );
            return $data;
        } //return $path;exit;
    }
    function rollback($uploaded, $i, $destinationFolder){
        for($r=0; $r<$i; $r++){
            unlink(getcwd().'/'.$destinationFolder.'/'.$uploaded[$r]);
            unlink(getcwd().'/'.$destinationFolder.'/thumbs/'.$uploaded[$r]);
        }
    }

    function deleteFile($file, $destinationFolder=""){

        if($file==""){exit;};
        $file = $this->trimCharacters($file);
        $flagFile = $this->checkDirectoryStatus($destinationFolder.'/'.$file); //flag for file
        if($flagFile==FALSE){
            unlink(getcwd().'/'.$destinationFolder.'/'.$file);
            return TRUE;
////////////////////////////////////////////////////////////////echo 'file deleted';
            exit;
        }
        else {
            $error = 'There is no such file that you are trying to delete. Please check your file name.';
            throw new Exception ($error);
            exit;
        }
    }
    function deleteDirectory($destinationFolder=""){
        if($destinationFolder==""){exit;};
        $destinationFolder = $this->trimCharacters($destinationFolder);
        $flagDest = $this->checkDirectoryStatus($destinationFolder); //flag for destination
        if($flagDest==FALSE){
            rmdir(getcwd().'/'.$destinationFolder);
            return TRUE;
////////////////////////////////////////////////////////////////echo 'Directory Deleted';
            exit;
        }
        else {
            $error = 'There is no such Directory that you are trying to delete. Please check your Directory name.';
            throw new Exception ($error);
            exit;
        }
    }
    
    
    //////////////////////////////////////////////////MADE FOR OPTICSTORE, UPLOADING PRESCRITION//////////////////////////////
    
    function upload_files($files, $destinationFolder){
        $allowedTypes=array('application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword', 'application/pdf','image/jpeg', 'image/gif', 'image/bmp', 'image/png');
        $maximum=5*1024*1024;  //5MB max
        foreach($files as $key => $val) {
            $arrayName = $key;
        }
           try {
                if((in_array($files[$arrayName]['type'], $allowedTypes)) && ($files[$arrayName]['size'])<$maximum)
                { 
                    $upFolder = getcwd().'/'.$destinationFolder;
                    $new_name = random_string('alnum', 4).'_'. $files[$arrayName]['name'];
                    $new_name = $this->trimCharacters($new_name);
                    $destination_file = $upFolder  .'/'. $new_name;
                    move_uploaded_file($files[$arrayName]['tmp_name'],  $destination_file);
                }
                else {
                    $error = 'Not valid file format. Please select a valid file format and try again.';
                    throw new Exception($error);
                    exit;
                }
            }
            catch (Exception $ex){
                print_r ($ex);
                exit;
            }
            return($new_name);
        }
}
?>