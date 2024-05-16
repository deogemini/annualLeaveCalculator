const mix = require('laravel-mix');

mix.babelConfig({
    presets: [
        [
            '@babel/preset-env',
            {
                targets: '> 0.25%, not dead',
                // Remove 'sourceType' option from here
            }
        ]
    ]
});
