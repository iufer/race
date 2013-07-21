define(['raphael'], function(Raphael){

	Raphael.fn.bubbleDefaults = {
		  		colors:[["#f78455","#ffffff"], 
						["#93dbdf", "#ffffff"], 						
						["#363636","#ffffff"], 
						["#c0dc7b","#ffffff"],
						["#f6d957","#ffffff"]
						],
				stroke:3,
				speed:90,
				texts: '#bubbletexts',
				dataClass: 'bubbledata',
				labelClass: 'bubblelabel'
		  	};
		  	
	Raphael.fn.makeBubble = function(originx, originy, rad, color, delay, data, label, dataClass, labelClass, strong) {
		var circle, a, width, top, left, labelsize, fontsize;
		circle = this.circle(originx, originy);
		circle.attr('fill-opacity', 0.8);
		circle.attr("fill", this.bubbleDefaults.colors[color][0]);
		circle.attr("stroke-width", this.bubbleDefaults.stroke);
		circle.attr("stroke", this.bubbleDefaults.colors[color][1]);
		a = Raphael.animation({'r':rad}, 700, 'elastic');
		circle.animate(a.delay(this.bubbleDefaults.speed * delay));
		
		width = rad * 2 * 0.75;
		top = originy - (rad * 0.5);
		left = originx - rad + (rad * 0.25);
		labelsize = Math.sqrt(width) * 1.3;
		fontsize = Math.sqrt(width) * 3;
		if(strong) fontsize *= 1.5;
		if(labelsize.length > 4) fontsize = fontsize * 0.8;
		
		d = $("<div />")
			.addClass(dataClass)
			.addClass(this.bubbleDefaults.dataClass)
			.hide()
			.css('position','absolute')
			.css('textAlign','center')
			.css('width', width)
			.css('top', top)
			.css('left', left)
			.css('fontSize', fontsize + 'pt')
			.html(data)
			.appendTo(this.bubbleDefaults.texts);
		
		top = originy + (rad * 0.2);
		if(strong) top += (rad * 0.2);
		
		l = $("<div />")
			.addClass(labelClass)
			.addClass(this.bubbleDefaults.labelClass)
			.hide()
			.css('position','absolute')
			.css('textAlign','center')
			.css('width', width)
			.css('top', top)
			.css('left', left)
			.css('fontSize', labelsize + 'pt')
			.html(label)
			.appendTo(this.bubbleDefaults.texts);
		
		setTimeout($.proxy(function(){ $(this.d).fadeIn('slow'); $(this.l).fadeIn('slow'); }, {d:d,l:l}), this.bubbleDefaults.speed * delay);
		
		return this;				
	}
});