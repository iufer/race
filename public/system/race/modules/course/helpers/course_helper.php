<?php

function courseAverageGrade($rise, $run) {
	return number_format(($rise / ($run *5280) * 100), 1);
}