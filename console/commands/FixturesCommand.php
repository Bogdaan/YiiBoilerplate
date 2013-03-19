<?php

class FixturesCommand extends CConsoleCommand
{
    public $fixturesPath;
    
    
    public function __construct($name,$runner){
        parent::__construct($name,$runner);
        $this->fixturesPath = Yii::getPathOfAlias('root').'/console/fixtures';
    }
    
    public function getHelp(){
        echo <<<'EOF'
Usage: yiic fixtures [load | loadall | list] --type=<name>
 Option "load":
   This command include fixture class file ( ROOT/console/fixtures/<name>Fixture.php )
   and call load() method. Require --type option.
 Option "loadall":
   Load all fixtures at ( ROOT/console/fixtures/ ).
 Option "list":
   Show all availible fixtures.
EOF;
        echo "\n";
    }
    
    public function actionIndex(){
        $this->getHelp();
    }
    
    public function actionLoad($type) {
        $fixturesPath = $this->fixturesPath;
        $fixtureClass = ucfirst($type).'Fixture';
        $fixtureFile = $fixtureClass.'.php';
        $fixtureFullPath = $fixturesPath.'/'.$fixtureFile;
        
        if( file_exists($fixtureFullPath) ){
            $ret =  $this->loadFromFile($fixtureFullPath, $fixtureClass);
            return $ret;
            
        }else{
            echo '*** fail: fixture file does not exists '.$fixtureFile.'('.$fixtureFullPath.')'."\n";
            return 1;
        }
    }
    

    public function actionList() {
        echo "*** availible fixtures:\n";
        $allFixtures = $this->getFixturesList();
        foreach($allFixtures as $fixture ){
            echo '-> '.$fixture['class']."\n";
        }
        echo "*** total:".count($allFixtures)."\n";
    }


    public function actionLoadall(){
        echo "*** load all fixtures:\n";

        $allFixtures = $this->getFixturesList();
        foreach($allFixtures as $fixture ){
            echo '*** load - '.$fixture['class'];
            $ret = $this->loadFromFile($fixture['path'], $fixture['class']);
            if($ret==0){
                echo " - success\n";
            }else{
                echo " - fail(".$ret.") \n";
            }
        }
        echo "*** total:".count($allFixtures)."\n";
    }
    
    
    protected function loadFromFile($fixtureFullPath, $fixtureClass){
        if(!file_exists($fixtureFullPath)){
            echo '*** fail: fixture file not found '.$fixtureClass.' ('.$fixtureFullPath.')'."\n";
            return 2;
        }
        Yii::import('root.console.fixtures.'.$fixtureClass);

        if(class_exists($fixtureClass)){
            $fixt = new $fixtureClass;
            if( method_exists($fixt, 'load') ){
                $fixt->load();
            }else{
                echo '*** fail: fixture method not found at '.$fixtureClass.' ('.$fixtureFullPath.')'."\n";
                return 3;
            }
    
        }else{
            echo '*** fail: fixture class not found '.$fixtureClass.' at '.$fixtureFullPath."\n";
            return 4;
        }
        
        return 0;
    }
    
    protected function getFixturesList(){
        $fixturesPath = $this->fixturesPath;

        $allFixtures = array();
        $hdir = opendir($fixturesPath);
        while ( ($fname=readdir($hdir))!==false ) {
            if( preg_match('/([[:alnum:]]+Fixture).php$/s', $fname, $pockets) ){
                $filePath = $fixturesPath.'/'.$fname;
                $fixtureClass = $pockets[1];
                
                $allFixtures[] = array(
                    'name'=>$fname, 
                    'path'=>$filePath,
                    'class'=>$fixtureClass,
                );
            }
        }
        closedir($hdir);
        
        return $allFixtures;
    }
    
}