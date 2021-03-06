<?php

/*
 * Git.php
 *
 * A PHP git library
 *
 * @package    Git.php
 * @version    0.1.4
 * @author     James Brumond
 * @copyright  Copyright 2013 James Brumond
 * @repo       http://github.com/kbjr/Git.php
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) die('Bad load order');

// ------------------------------------------------------------------------

/**
 * Git Interface Class
 *
 * This class enables the creating, reading, and manipulation
 * of git repositories.
 *
 * @class  Git
 */
class Git {

	/**
	 * Git executable location
	 *
	 * @var string
	 */
	protected static $bin = '/usr/bin/git';

	/**
	 * Sets git executable path
	 *
	 * @param string $path executable location
	 */
	public static function set_bin($path) {
		self::$bin = $path;
	}

	/**
	 * Gets git executable path
	 */
	public static function get_bin() {
		/* set to git if on windows */
		if(PHP_OS == 'WINNT' || PHP_OS == 'WIN32' || PHP_OS == 'Windows'){
			self::set_bin('git');
		}
		return self::$bin;
	}

	/**
	 * Sets up library for use in a default Windows environment
	 */
	public static function windows_mode() {
		self::set_bin('git');
	}

	/**
	 * Create a new git repository
	 *
	 * Accepts a creation path, and, optionally, a source path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  directory to source
	 * @return  GitRepo
	 */
	public static function &create($repo_path, $source = null) {
		return GitRepo::create_new($repo_path, $source);
	}

	/**
	 * Open an existing git repository
	 *
	 * Accepts a repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @return  GitRepo
	 */
	public static function open($repo_path) {
		return new GitRepo($repo_path);
	}

	/**
	 * Clones a remote repo into a directory and then returns a GitRepo object
	 * for the newly created local repo
	 *
	 * Accepts a creation path and a remote to clone from
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  remote source
	 * @return  GitRepo
	 **/
	public static function &clone_remote($repo_path, $remote) {
		return GitRepo::create_new($repo_path, $remote, true);
	}

	/**
	 * Checks if a variable is an instance of GitRepo
	 *
	 * Accepts a variable
	 *
	 * @access  public
	 * @param   mixed   variable
	 * @return  bool
	 */
	public static function is_repo($var) {
		return (get_class($var) == 'GitRepo');
	}

}

// ------------------------------------------------------------------------

/**
 * Git Repository Interface Class
 *
 * This class enables the creating, reading, and manipulation
 * of a git repository
 *
 * @class  GitRepo
 */
class GitRepo {

	protected $repo_path = null;
	protected $bare = false;
	protected $envopts = array();

	/**
	 * Create a new git repository
	 *
	 * Accepts a creation path, and, optionally, a source path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  directory to source
	 * @return  GitRepo
	 */
	public static function &create_new($repo_path, $source = null, $remote_source = false) {
		if (is_dir($repo_path) && file_exists($repo_path."/.git") && is_dir($repo_path."/.git")) {
			throw new Exception('"'.$repo_path.'" is already a git repository');
		} else {
			$repo = new self($repo_path, true, false);
			if (is_string($source)) {
				if ($remote_source) {
					$repo->clone_remote($source);
				} else {
					$repo->clone_from($source);
				}
			} else {
				$repo->run('init');
			}
			return $repo;
		}
	}

	/**
	 * Constructor
	 *
	 * Accepts a repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   bool    create if not exists?
	 * @return  void
	 */
	public function __construct($repo_path = null, $create_new = false, $_init = true) {
		if (is_string($repo_path)) {
			$this->set_repo_path($repo_path, $create_new, $_init);
		}
	}

	/**
	 * Set the repository's path
	 *
	 * Accepts the repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   bool    create if not exists?
	 * @param   bool    initialize new Git repo if not exists?
	 * @return  void
	 */
	public function set_repo_path($repo_path, $create_new = false, $_init = true) {
		if (is_string($repo_path)) {
			if ($new_path = realpath($repo_path)) {
				$repo_path = $new_path;
				if (is_dir($repo_path)) {
					// Is this a work tree?
					if (file_exists($repo_path."/.git") && is_dir($repo_path."/.git")) {
						$this->repo_path = $repo_path;
						$this->bare = false;
					// Is this a bare repo?
					} else if (is_file($repo_path."/config")) {
					  $parse_ini = parse_ini_file($repo_path."/config");
						if ($parse_ini['bare']) {
							$this->repo_path = $repo_path;
							$this->bare = true;
						}
					} else {
						if ($create_new) {
							$this->repo_path = $repo_path;
							if ($_init) {
								$this->run('init');
							}
						} else {
							throw new Exception('"'.$repo_path.'" is not a git repository');
						}
					}
				} else {
					throw new Exception('"'.$repo_path.'" is not a directory');
				}
			} else {
				if ($create_new) {
					if ($parent = realpath(dirname($repo_path))) {
						mkdir($repo_path);
						$this->repo_path = $repo_path;
						if ($_init) $this->run('init');
					} else {
						throw new Exception('cannot create repository in non-existent directory');
					}
				} else {
					throw new Exception('"'.$repo_path.'" does not exist');
				}
			}
		}
	}

	/**
	 * Tests if git is installed
	 *
	 * @access  public
	 * @return  bool
	 */
	public function test_git() {
		$descriptorspec = array(
			1 => array('pipe', 'w'),
			2 => array('pipe', 'w'),
		);
		$pipes = array();
		$resource = proc_open(Git::get_bin(), $descriptorspec, $pipes);

		$stdout = stream_get_contents($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		foreach ($pipes as $pipe) {
			fclose($pipe);
		}

		$status = trim(proc_close($resource));
		return ($status != 127);
	}

	/**
	 * Run a command in the git repository
	 *
	 * Accepts a shell command to run
	 *
	 * @access  protected
	 * @param   string  command to run
	 * @return  string
	 */
	protected function run_command($command) {
		$descriptorspec = array(
			1 => array('pipe', 'w'),
			2 => array('pipe', 'w'),
		);
		$pipes = array();
		/* Depending on the value of variables_order, $_ENV may be empty.
		 * In that case, we have to explicitly set the new variables with
		 * putenv, and call proc_open with env=null to inherit the reset
		 * of the system.
		 *
		 * This is kind of crappy because we cannot easily restore just those
		 * variables afterwards.
		 *
		 * If $_ENV is not empty, then we can just copy it and be done with it.
		 */
		if(count($_ENV) === 0) {
			$env = NULL;
			foreach($this->envopts as $k => $v) {
				putenv(sprintf("%s=%s",$k,$v));
			}
		} else {
			$env = array_merge($_ENV, $this->envopts);
		}
		$cwd = $this->repo_path;
		$resource = proc_open($command, $descriptorspec, $pipes, $cwd, $env);

		$stdout = stream_get_contents($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		foreach ($pipes as $pipe) {
			fclose($pipe);
		}

		$status = trim(proc_close($resource));
		if ($status){return $stderr;}

		return $stdout;
	}

	/**
	 * Run a git command in the git repository
	 *
	 * Accepts a git command to run
	 *
	 * @access  public
	 * @param   string  command to run
	 * @return  string
	 */
	public function run($command) {
		return $this->run_command(Git::get_bin()." ".$command);
	}
	/**
	 * Runs a 'git log' call
	 *
	 * @access public
	 * @param string  file to log <br />
	 * @return array
	 */
	public function log($file) {
		$msg = $this->run("log \"{$file}\"");
		$lines=preg_split('/[\r\n]+/',trim($msg));
		$rtn=array('repo_path'=>$this->repo_path);
		$rtn['raw']=$lines;
		return $rtn;
	}
	/**
	 * Runs a 'git diff' call
	 *
	 * @access public
	 * @param string  file to diff <br />
	 * @return array
	 */
	public function diff($file) {
		$msg = $this->run("diff \"{$file}\"");
		$lines=preg_split('/[\r\n]+/',trim($msg));
		$rtn=array('repo_path'=>$this->repo_path);
		$rtn['raw']=$lines;
		return $rtn;
	}
	/**
	 * Runs a 'git status' call
	 *
	 * Accept a convert to HTML bool
	 *
	 * @access public
	 * @param bool  return string with <br />
	 * @return string
	 */
	public function status($format = 'array') {
		$msg = $this->run("status");
		$lines=preg_split('/[\r\n]+/',trim($msg));
		$rtn=array('repo_path'=>$this->repo_path);
		$marker='';
		foreach($lines as $i=>$line){
	    	$line=trim($line);
	    	//skip blank lines
	    	if(!strlen($line)){continue;}
	    	if(preg_match('/^On branch ([a-z0-9\-]+)/i',$line,$m)){
				$rtn['branch']=$m[1];
				continue;
			}
	    	elseif(preg_match('/^Your branch is ([a-z0-9\-]+)/i',$line,$m)){
				$rtn['status']=$m[1];
				continue;
			}
			elseif(stringContains($line,'use "git')){continue;}
			elseif(preg_match('/^modified\:(.+)$/i',$line,$m)){
	        	$rtn['files'][]=$this->fileinfo(trim($m[1]),'modified');
	        	continue;
			}
			elseif(preg_match('/^deleted\:(.+)$/i',$line,$m)){
	        	$rtn['files'][]=$this->fileinfo(trim($m[1]),'deleted');
	        	continue;
			}
			elseif(preg_match('/^(new|new file)\:(.+)$/i',$line,$m)){
	        	$rtn['files'][]=$this->fileinfo(trim($m[2]),'added');
	        	continue;
			}
			//skip comment lines
			if(preg_match('/^\(/',$line)){continue;}
			if(preg_match('/^Untracked files\:/i',$line)){
	        	$marker='new';
	        	continue;
			}
			if(!strlen($marker)){continue;}
			if($marker=='new'){
	        	$rtn['files'][]=$this->fileinfo(trim($line),'new');
			}
			else{
				$rtn[$marker][]=trim($line);
			}

		}
		//clean up duplicates caused by newfile
		$modified=array();
		if(!is_array($rtn['files'])){$rtn['files']=array();}
		foreach($rtn['files'] as $i=>$file){
			if($file['status']=='modified'){$modified[]=$file['name'];}
		}
		foreach($rtn['files'] as $i=>$file){
			if($file['status']=='added' && in_array($file['name'],$modified)){
				unset($rtn['files'][$i]);
			}
		}
		$rtn['raw']=$lines;
		switch(strtolower(trim($format))){
        	case 'raw':
        	case 'txt':
        		return implode("\n",$rtn['raw']);
        	break;
        	case 'html':
				return implode("<br />\n",$rtn['raw']);
        	break;
        	default:
				return $rtn;
        	break;
		}
	}
	private function fileinfo($name,$status){
		$repo=$this->repo_path;
		$afile="{$repo}/{$name}";
		$guid=sha1($name);
		if(!is_file($afile)){
			//deleted
        	$rtn=array(
				'name'		=> $name,
				'guid'		=> $guid,
				'status'	=> $status,
	        	'afile'		=> $afile,
			);
			return $rtn;

		}
		$info=lstat($afile);

	    $rtn=array(
			'name'		=> $name,
			'guid'		=> $guid,
			'status'	=> $status,
			'lines'		=> getFileLineCount($afile),
			'size'		=> $info['size'],
			'type'		=> filetype($afile),
        	'afile'		=> $afile,
        	'size_verbose'=>verboseSize($info['size']),
		);
    	$rtn['_cdate_utime']=$info['ctime'];
		$rtn['_cdate_age']=time()-$rtn['_cdate_utime'];
		if($rtn['_cdate_age'] < 0){$rtn['_cdate_age']=0;}
		$rtn['_cdate_age_verbose']=verboseTime($rtn['_cdate_age']);
		$rtn['_cdate']=date('m/d/Y g:i a',$rtn['_cdate_utime']);
		$rtn['_edate_utime']=$info['mtime'];
		$rtn['_edate_age']=time()-$rtn['_edate_utime'];
		if($rtn['_edate_age'] < 0){$rtn['_edate_age']=0;}
		$rtn['_edate_age_verbose']=verboseTime($rtn['_edate_age']);
		$rtn['_edate']=date('m/d/Y g:i a',$rtn['_edate_utime']);
		$rtn['_adate_utime']=$info['atime'];
		$rtn['_adate_age']=time()-$rtn['_adate_utime'];
		if($rtn['_adate_age'] < 0){$rtn['_adate_age']=0;}
		$rtn['_adate_age_verbose']=verboseTime($rtn['_adate_age']);
		$rtn['_adate']=date('m/d/Y g:i a',$rtn['_adate_utime']);
		return $rtn;
	}
	/**
	 * Runs a `git add` call
	 *
	 * Accepts a list of files to add
	 *
	 * @access  public
	 * @param   mixed   files to add
	 * @return  string
	 */
	public function add($files = "*") {
		if (is_array($files)) {
			$files = '"'.implode('" "', $files).'"';
		}
		return $this->run("add $files -v");
	}

	/**
	 * Runs a `git rm` call
	 *
	 * Accepts a list of files to remove
	 *
	 * @access  public
	 * @param   mixed    files to remove
	 * @param   Boolean  use the --cached flag?
	 * @return  string
	 */
	public function rm($files = "*", $cached = false) {
		if (is_array($files)) {
			$files = '"'.implode('" "', $files).'"';
		}
		return $this->run("rm ".($cached ? '--cached ' : '').$files);
	}


	/**
	 * Runs a `git commit` call
	 *
	 * Accepts a commit message string
	 *
	 * @access  public
	 * @param   string  commit message
	 * @param   string  filename or 'all' for all files
	 * @return  string
	 */
	public function commit($message = "", $file='') {
		if($file=='' || $file=='all'){$flags='-av';}
		else{$flags='-v';}
		$afile=is_file($file)?$file:$this->repo_path."/{$file}";
		if($flags=='-av'){
			return $this->run("commit {$flags} -m ".escapeshellarg($message));
		}
		else{
			return $this->run("commit {$flags} -m ".escapeshellarg($message).' '.escapeshellarg($afile));
		}
	}

	/**
	 * Runs a `git clone` call to clone the current repository
	 * into a different directory
	 *
	 * Accepts a target directory
	 *
	 * @access  public
	 * @param   string  target directory
	 * @return  string
	 */
	public function clone_to($target) {
		return $this->run("clone --local ".$this->repo_path." $target");
	}

	/**
	 * Runs a `git clone` call to clone a different repository
	 * into the current repository
	 *
	 * Accepts a source directory
	 *
	 * @access  public
	 * @param   string  source directory
	 * @return  string
	 */
	public function clone_from($source) {
		return $this->run("clone --local $source ".$this->repo_path);
	}

	/**
	 * Runs a `git clone` call to clone a remote repository
	 * into the current repository
	 *
	 * Accepts a source url
	 *
	 * @access  public
	 * @param   string  source url
	 * @return  string
	 */
	public function clone_remote($source) {
		return $this->run("clone $source ".$this->repo_path);
	}

	/**
	 * Runs a `git clean` call
	 *
	 * Accepts a remove directories flag
	 *
	 * @access  public
	 * @param   bool    delete directories?
	 * @param   bool    force clean?
	 * @return  string
	 */
	public function clean($dirs = false, $force = false) {
		return $this->run("clean".(($force) ? " -f" : "").(($dirs) ? " -d" : ""));
	}

	/**
	 * Runs a `git branch` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function create_branch($branch) {
		return $this->run("branch $branch");
	}

	/**
	 * Runs a `git branch -[d|D]` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function delete_branch($branch, $force = false) {
		return $this->run("branch ".(($force) ? '-D' : '-d')." $branch");
	}

	/**
	 * Runs a `git branch` call
	 *
	 * @access  public
	 * @param   bool    keep asterisk mark on active branch
	 * @return  array
	 */
	public function list_branches($keep_asterisk = false) {
		$branchArray = explode("\n", $this->run("branch"));
		foreach($branchArray as $i => &$branch) {
			$branch = trim($branch);
			if (! $keep_asterisk) {
				$branch = str_replace("* ", "", $branch);
			}
			if ($branch == "") {
				unset($branchArray[$i]);
			}
		}
		return $branchArray;
	}

	/**
	 * Lists remote branches (using `git branch -r`).
	 *
	 * Also strips out the HEAD reference (e.g. "origin/HEAD -> origin/master").
	 *
	 * @access  public
	 * @return  array
	 */
	public function list_remote_branches() {
		$branchArray = explode("\n", $this->run("branch -r"));
		foreach($branchArray as $i => &$branch) {
			$branch = trim($branch);
			if ($branch == "" || strpos($branch, 'HEAD -> ') !== false) {
				unset($branchArray[$i]);
			}
		}
		return $branchArray;
	}

	/**
	 * Returns name of active branch
	 *
	 * @access  public
	 * @param   bool    keep asterisk mark on branch name
	 * @return  string
	 */
	public function active_branch($keep_asterisk = false) {
		$branchArray = $this->list_branches(true);
		$active_branch = preg_grep("/^\*/", $branchArray);
		reset($active_branch);
		if ($keep_asterisk) {
			return current($active_branch);
		} else {
			return str_replace("* ", "", current($active_branch));
		}
	}

	/**
	 * Runs a `git checkout` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function checkout($branch) {
		return $this->run("checkout $branch");
	}


	/**
	 * Runs a `git merge` call
	 *
	 * Accepts a name for the branch to be merged
	 *
	 * @access  public
	 * @param   string $branch
	 * @return  string
	 */
	public function merge($branch) {
		return $this->run("merge $branch --no-ff");
	}


	/**
	 * Runs a git fetch on the current branch
	 *
	 * @access  public
	 * @return  string
	 */
	public function fetch() {
		return $this->run("fetch");
	}

	/**
	 * Add a new tag on the current position
	 *
	 * Accepts the name for the tag and the message
	 *
	 * @param string $tag
	 * @param string $message
	 * @return string
	 */
	public function add_tag($tag, $message = null) {
		if ($message === null) {
			$message = $tag;
		}
		return $this->run("tag -a $tag -m $message");
	}

	/**
	 * List all the available repository tags.
	 *
	 * Optionally, accept a shell wildcard pattern and return only tags matching it.
	 *
	 * @access	public
	 * @param	string	$pattern	Shell wildcard pattern to match tags against.
	 * @return	array				Available repository tags.
	 */
	public function list_tags($pattern = null) {
		$tagArray = explode("\n", $this->run("tag -l $pattern"));
		foreach ($tagArray as $i => &$tag) {
			$tag = trim($tag);
			if ($tag == '') {
				unset($tagArray[$i]);
			}
		}

		return $tagArray;
	}

	/**
	 * Push specific branch to a remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote
	 * @param string $branch
	 * @return string
	 */
	public function push($remote, $branch) {
		return $this->run("push --tags $remote $branch");
	}

	/**
	 * Pull specific branch from remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote
	 * @param string $branch
	 * @return string
	 */
	public function pull($remote, $branch) {
		return $this->run("pull $remote $branch");
	}

	/**
	 * Sets the project description.
	 *
	 * @param string $new
	 */
	public function set_description($new) {
		file_put_contents($this->repo_path."/.git/description", $new);
	}

	/**
	 * Gets the project description.
	 *
	 * @return string
	 */
	public function get_description() {
		return file_get_contents($this->repo_path."/.git/description");
	}
	/**
	 * Gets the project repo_path.
	 *
	 * @return string
	 */
	public function get_repo_path() {
		return $this->repo_path;
	}

	/**
	 * Sets custom environment options for calling Git
	 *
	 * @param string key
	 * @param string value
	 */
	public function setenv($key, $value) {
		$this->envopts[$key] = $value;
	}

}

/* End of file */
