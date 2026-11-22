(function (wp) {
    const { registerBlockType } = wp.blocks;
    const { useBlockProps } = wp.blockEditor;
    const { createElement } = wp.element;
    const { __ } = wp.i18n;

    registerBlockType('reading-time-block/reading-time', {
        title: 'Reading Time',
        icon: 'clock',
        category: 'widgets',
        edit: function () {
            return createElement(
                'p',
                useBlockProps(),
                __('Reading time will be calculated based on the post content.', 'reading-time-block')
            );
        },
        save: function () {
            return null;
        },
    });
})(window.wp);
