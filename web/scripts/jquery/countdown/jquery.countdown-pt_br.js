/* http://keith-wood.name/countdown.html
   Brazilian initialisation for the jQuery countdown extension
   Translated by Marcelo Pellicano de Oliveira (pellicano@gmail.com) Feb 2008. */
(function($) {
	$.countdown.regional['pt_br'] = {
		labels: ['Anos', 'Meses', 'Semanas', 'Dias', 'Horas', 'Minutos', 'Segundos'],
		labels1: ['Ano', 'Mês', 'Semana', 'Dia', 'Hora', 'Minuto', 'Segundo'],
		compactLabels: ['a', 'm', 's', 'd'],
		whichLabels: null,
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['pt_br']);
})(jQuery);
