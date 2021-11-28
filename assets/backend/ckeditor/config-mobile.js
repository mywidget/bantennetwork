CKEDITOR.replace('editor', {
	uiColor: '#fdfdff',
	language: 'en', // id, es, en, dll
	width: '100%',
	height: 250,
	toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'TextColor', 'BGColor','-','Bold', 'Italic', 'Underline' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'insert', items: [ 'Image', 'HorizontalRule', 'PageBreak'] },
		{ name: 'styles', items: ['Font', 'FontSize' ] }
	]
});