/* http://keith-wood.name/countdown.html
   Brazilian initialisation for the jQuery countdown extension
   Translated by Marcelo Pellicano de Oliveira (pellicano@gmail.com) Feb 2008. */
(function($) {
	$.countdown.regional['tr_tr'] = {
		labels: ['Yıllar', 'Aylar', 'Haftalar', 'Günler', 'Saatler', 'Dakikalar', 'Saniyeler'],
		labels1: ['Yıl', 'Ay', 'Hafta', 'Gün', 'Saat', 'Dakika', 'Saniye'],
		compactLabels: ['y', 'a', 'h', 'g'],
		whichLabels: null,
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['tr_tr']);
})(jQuery);
