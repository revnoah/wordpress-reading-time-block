(function (wp) {
    const { registerBlockType } = wp.blocks;
    const { createElement } = wp.element;
    const { __ } = wp.i18n;

    registerBlockType('reading-time-block/block', {
        title: __('Reading Time', 'reading-time-block'),
        icon: 'clock',
        category: 'widgets',
        edit: function () {
            return createElement(
                'p',
                {},
                __('Reading time will be calculated based on the post content.', 'reading-time-block')
            );
        },
        save: function () {
            return null;
        },
    });
})(window.wp);
