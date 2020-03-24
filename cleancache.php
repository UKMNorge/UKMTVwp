<?php

# Cleans the cache database - remove all entries that checked in for more than 2 minutes ago
# wowza.video.ukm.no can't run the python heartbeat (windows..), so it's set manually. 
# This function won't clean the main cache if ID matches.
# If it expires, add 81.0.146.164 to cache DB. (Static IP for wowza.video.ukm.no per 01.03.2016)

# Oops: Check timezone!

use UKMNorge\Database\SQL\Delete;
use UKMNorge\Database\SQL\Query;

$time = time() - (2*60); # Two minutes from now
$main = 1;

$caches = new Query("SELECT * 
					FROM `ukm_tv_caches_caches` 
					WHERE UNIX_TIMESTAMP(`last_heartbeat`) < '#time'
					AND `deactivated` = 1", array('time' => $time));
echo $caches->debug();

$res = $caches->run();

if(!$res) {
	#Failed to get a result from DB
	error_log('UKMTVwp_cache_clean: Failed to get a result from DB, quitting.');
	die();
}
$count = 0;
$errors = 0;
while($cache = Query::fetch($res)) {
	if ($cache['id'] == $main) {
		echo "UKMTVwp_cache_clean: Skipping cache with id ".$cache['id'];
		error_log("UKMTVwp_cache_clean: Skipping cache with id ".$cache['id']);
		continue;
	}
	$del = new Delete('ukm_tv_caches_caches', array('id' => $cache['id']));

	#echo $del->debug();
	$res2 = $del->run();
	if (!$res2) {
		# ERROR - Failed to remove cache from DB
		$errors++;
		error_log('UKMTVwp_cache_clean: Failed to remove cache with id: '.$cache['id'].' from DB.');
	}
	$count++;
}

echo '<p>&nbsp;</p>';
if($count) 
	echo '<div class="alert alert-success">Successfully cleaned '.$count.' caches from database.</div>';
if($errors)
	echo '<div class="alert alert-danger">Failed to clean '.$errors.' caches from database.</div>';
if(!$count && !$errors)
	echo '<div class="alert alert-info">Nothing to remove.</div>';