--TEST--
Test for bug #1388: Resolved Breakpoint: resolved with breakpoint set in current scope
--SKIPIF--
<?php
require __DIR__ . '/utils.inc';
check_reqs('dbgp');
?>
--FILE--
<?php
require 'dbgp/dbgpclient.php';
$filename = dirname(__FILE__) . '/bug01388-19.inc';

$commands = array(
	'feature_set -n resolved_breakpoints -v 1',
	'step_into',
	"breakpoint_set -t line -f file://{$filename} -n 2",
	"breakpoint_set -t line -f file://{$filename} -n 4",
	"breakpoint_set -t line -f file://{$filename} -n 8",
	"breakpoint_set -t line -f file://{$filename} -n 9",
	'run',
	'run',
	'run',
	'run',
	'detach',
);

dbgpRunFile( $filename, $commands );
?>
--EXPECT--
<?xml version="1.0" encoding="iso-8859-1"?>
<init xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" fileuri="file://bug01388-19.inc" language="PHP" xdebug:language_version="" protocol_version="1.0" appid="" idekey=""><engine version=""><![CDATA[Xdebug]]></engine><author><![CDATA[Derick Rethans]]></author><url><![CDATA[https://xdebug.org]]></url><copyright><![CDATA[Copyright (c) 2002-2099 by Derick Rethans]]></copyright></init>

-> feature_set -i 1 -n resolved_breakpoints -v 1
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="feature_set" transaction_id="1" feature="resolved_breakpoints" success="1"></response>

-> step_into -i 2
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="step_into" transaction_id="2" status="break" reason="ok"><xdebug:message filename="file://bug01388-19.inc" lineno="2"></xdebug:message></response>

-> breakpoint_set -i 3 -t line -f file://bug01388-19.inc -n 2
<?xml version="1.0" encoding="iso-8859-1"?>
<notify xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" name="breakpoint_resolved"><breakpoint type="line" resolved="resolved" filename="file://bug01388-19.inc" lineno="2" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint></notify>

<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_set" transaction_id="3" id="" resolved="resolved"></response>

-> breakpoint_set -i 4 -t line -f file://bug01388-19.inc -n 4
<?xml version="1.0" encoding="iso-8859-1"?>
<notify xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" name="breakpoint_resolved"><breakpoint type="line" resolved="resolved" filename="file://bug01388-19.inc" lineno="5" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint></notify>

<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_set" transaction_id="4" id="" resolved="resolved"></response>

-> breakpoint_set -i 5 -t line -f file://bug01388-19.inc -n 8
<?xml version="1.0" encoding="iso-8859-1"?>
<notify xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" name="breakpoint_resolved"><breakpoint type="line" resolved="resolved" filename="file://bug01388-19.inc" lineno="8" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint></notify>

<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_set" transaction_id="5" id="" resolved="resolved"></response>

-> breakpoint_set -i 6 -t line -f file://bug01388-19.inc -n 9
<?xml version="1.0" encoding="iso-8859-1"?>
<notify xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" name="breakpoint_resolved"><breakpoint type="line" resolved="resolved" filename="file://bug01388-19.inc" lineno="9" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint></notify>

<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_set" transaction_id="6" id="" resolved="resolved"></response>

-> run -i 7
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="run" transaction_id="7" status="break" reason="ok"><xdebug:message filename="file://bug01388-19.inc" lineno="5"></xdebug:message></response>

-> run -i 8
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="run" transaction_id="8" status="break" reason="ok"><xdebug:message filename="file://bug01388-19.inc" lineno="8"></xdebug:message></response>

-> run -i 9
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="run" transaction_id="9" status="break" reason="ok"><xdebug:message filename="file://bug01388-19.inc" lineno="9"></xdebug:message></response>

-> run -i 10
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="run" transaction_id="10" status="stopping" reason="ok"></response>

-> detach -i 11
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="detach" transaction_id="11" status="stopping" reason="ok"></response>