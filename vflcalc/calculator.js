	function calculateStake() {
		add = num-1;
		
		if(add==1) {
			$target = $("#target").val();
		} else {
			$target = $("#winOrLose"+(num-2)).val();
		}

		$odd = $("#row"+add).val();
		if ($odd!="") {
			$stake = $target/($odd - 1);
			$stake = round($stake);
			$winOrLose = round($stake * $odd);
			$("#stake"+add).val($stake);
			$("#winOrLose"+add).val($winOrLose);

		} else {
			$("#stake"+add).val("");			
			$("#winOrLose"+add).val("");
		}

		function round(num) {
			return Math.round(num * 100) / 100;
		}
	}

	function topFormData () {
		$target = $("#target").val();
		if($target!="") {
			$("#minStake").val("50");
			$minStake = $("#minStake").val();

			$("#idealBalance").val(idealBalance($target));
			$("#maxOdd").val(maxOdd($target));
		} else {
			$("#idealBalance").val("");
			$("#maxOdd").val(maxOdd(""));
		}

		function idealBalance (target) {
			return target*150;
		}

		function maxOdd (target) {
			return (target/$minStake) + 1;
		}
	}

	//serial number generator
	function serialNo() {
		return num+=1;
	}