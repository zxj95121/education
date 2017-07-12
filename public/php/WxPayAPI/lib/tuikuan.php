<?php 
	require_once $_SERVER['DOCUMENT_ROOT']."/php/WxPayAPI/lib/WxPay.Api.php";
	$out_trade_no = $flight->order_no;
	$total_fee = 1;
	$refund_fee = 1;
	$input = new WxPayRefund();
	$input->SetOut_trade_no($out_trade_no);
	$input->SetTotal_fee($total_fee);
	$input->SetRefund_fee($refund_fee);
	$input->SetOut_refund_no(WxPayConfig::MCHID.date("YmdHis"));
	$input->SetOp_user_id(WxPayConfig::MCHID);
	$res = WxPayApi::refund($input);
?>