<?
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

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/googleChart.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Code to generate pie chart of google API
	 * Reference: http://code.google.com/intl/pt-BR/apis/chart/docs/gallery/pie_charts.html
	 * $_GET["chart_number"]	= number of chart to optimizer when use more then 1 chart on page
	 * $_GET["width"]			= width of chart
	 * $_GET["height"]			= height of chart
	 * $_GET["chart_values"]	= Values to chart. Example: 10,20,30
	 * $_GET["labels"]			= Values to label or legend. Example: Label 1 | Label 2
	 * $_GET["legend"]			= Values to legend. Example: legend 1 | legend 2
	 * $_GET["colors"]			= Values to colors of chart. Example: 00FF00|CCCCCC|DDDDDD
	 * $_GET["background"]		= Value to background color
	 */
	$clientURL = 'http://'.($_GET["chart_number"] ? $_GET["chart_number"]."." : "").'chart.apis.google.com/chart?'. md5(uniqid(rand(), true));
	$agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)";

	if($_GET["width"] || $_GET["height"] || $_GET["chart_values"]){
		$chd = 't:'.$_GET["chart_values"];
		
		$chart = array(
			'cht' => 'p',
			'chs' => $_GET["width"].'x'.$_GET["height"],
			'chco' => ($_GET["colors"] ? $_GET["colors"] : '0000FF'),
			'chd' => $chd
		);

		/*
		 * Add label
		 */
		if($_GET["labels"]){
			$chart["chl"] = $_GET["labels"];
		}

		/*
		 * Add legend
		 */
		if($_GET["legend"]){
			$chart["chdl"] = $_GET["legend"];
		}

		/*
		 * Background Color
		 */
		if($_GET["background"]){
			$chart["chf"] = "bg,s,".$_GET["background"];
		}

		$parameters = http_build_query($chart);

		$req = $parameters;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $clientURL);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_NOPROGRESS, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$response = curl_exec($ch);
		curl_close($ch);
		header('content-type: image/png');
		echo $response;
		
	}
	exit;
?>
