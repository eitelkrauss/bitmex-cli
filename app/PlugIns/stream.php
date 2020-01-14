<?php


require __DIR__.'/../../vendor/autoload.php';

\Ratchet\Client\connect('wss://www.bitmex.com/realtime?subscribe=trade:XBTUSD')->then(function($conn) {
        $conn->on('message', function($msg) use ($conn) {
		$bitmex_data = json_decode($msg);
		if(property_exists($bitmex_data, 'data')){
			foreach($bitmex_data->data as $datapoint){
				$price = $datapoint->price;
				$size = $datapoint->size;
				$datapoint->side == "Buy"
				? print "	\e[92m$price	  |	$size\n"
				: print "	\e[91m$price	  |	$size\n";
            }
		}
	});
});
