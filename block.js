(function (wp) {
    const { registerBlockType } = wp.blocks;
    const { createElement } = wp.element;

    registerBlockType('reading-time-block/block', {
        title: 'Reading Time',
        icon: 'clock',
        category: 'widgets',
        edit: function () {
            return createElement(
                'p',
                {},
                'Reading time will be calculated based on the post content.'
            );
        },
        save: function () {
            return null;
        },
    });
})(window.wp);
