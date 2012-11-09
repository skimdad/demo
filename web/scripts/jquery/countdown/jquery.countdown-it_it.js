/* http://keith-wood.name/countdown.html
 * Italian initialisation for the jQuery countdown extension
 * Written by Davide Bellettini (davide.bellettini@gmail.com) Feb 2008. */
(function($) {
	$.countdown.regional['it_it'] = {
		labels: ['Anni', 'Mesi', 'Settimane', 'Giorni', 'Ore', 'Minuti', 'Secondi'],
		labels1: ['Anno', 'Mese', 'Settimana', 'Giorno', 'Ora', 'Minuto', 'Secondo'],
		compactLabels: ['a', 'm', 's', 'g'],
		whichLabels: null,
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['it_it']);
})(jQuery);
