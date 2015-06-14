<!DOCTYPE html>
<?php
ini_set('display_errors', true);
include '../../init.php';
include( "functions.php" );
include( "servicePlex.class.php" );
include( "serviceSAB.class.php" );
include( "serviceSonarr.class.php" );
include( "serviceCouch.class.php" );
?>
<html lang="en">
<script>
	// Enable bootstrap tooltips
	$(function () {
		$("[rel=tooltip]").tooltip();
	});
</script>
<?php
$plex_protocol = protocolCheck($plex_ssl);
$sab_protocol = protocolCheck($sab_ssl);
$sonarr_protocol = protocolCheck($sonarr_ssl);
$couch_protocol = protocolCheck($couch_ssl);

$services = array(
	new servicePlex("Plex", $plex_port, ($plex_protocol . 'plex.tv/web' ), $plex_server_ip, $plex_ssl),
	new serviceSAB("SABnzbd", $sab_port, ($sab_protocol . $domain_name . '/sabnzbd' ), $sab_ip, $sabnzbd_api, $sab_ssl),
	new serviceSonarr("Sonarr", $sonarr_port, ($sonarr_protocol . $domain_name . '/tv'), $sonarr_ip, $sonarr_api, $sonarr_ssl),
	new serviceCouch("CouchPotato", $couch_port, ($couch_protocol . $domain_name . '/movies') , $couch_ip, $couchpotato_api, $couch_ssl),
);
?>
<table class="table">
	<?php foreach ($services as $service)
	{
		?>
		<tr>
			<td style="text-align: right; padding-right:5px;" class="exoextralight"><?php echo $service->name; ?></td>
			<td style="text-align: left;"><?php echo $service->make_button(); ?></td>
		</tr>
	<?php } ?>
</table>