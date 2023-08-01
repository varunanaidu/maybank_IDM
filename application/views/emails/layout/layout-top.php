<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.container-fluid {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translateY(-50%) translateX(-50%);
			width: 100%;
			height: 1000px;
		}
		.ticket {
			border-radius: 4px;
			display: inline-block;
			max-width: 400px;
			width: 100%;
			height: 1000px;
		}

		.ticket.light {
			background-color: white;
			color: #161616;
		}
		.ticket.light .ticket-body {
			border-color: #161616;
		}
		.ticket-head {
			background-position: center;
			background-size: cover;
			border-radius: 4px 4px 0 0;
			color: white;
			position: relative;
			height: 1000px;
		}
		.ticket-body {
			top: 50%;
			left: 50%;
			position: relative;
		}
		.ticket-body p {
			color: #A2A2A2;
			font-size: 12px;
		}

	</style>
</head>
<body style="font-size:14px; background-color:#EEEEEE;">
	<div id="main-wrapper">