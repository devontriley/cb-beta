module.exports = {
    plugins: {
        'postcss-import': {}, // Resolve @import statements first so cssnext can run all css in a single file
        'postcss-mixins': {},
        'postcss-preset-env': {},
        'postcss-css-reset': {},
        'postcss-nested': {},
        'postcss-font-magician': {
            'variants': {
                'Open Sans': {
                    '400': [],
                    '700': []
                }
            },
            'custom': {
                'Bariol': {
                    'variants': {
                        'normal': {
                            '300': {
                                'url': {
                                    'woff': './../fonts/bariol_thin-webfont.woff',
                                    'woff2': './../fonts/bariol_thin-webfont.woff2',
                                    'ttf': './../fonts/bariol_thin-webfont.ttf',
                                    'eot': './../fonts/bariol_thin-webfont.eot',
                                }
                            },
                            '400': {
                                'url': {
                                    'woff': './../fonts/bariol_regular-webfont.woff',
                                    'woff2': './../fonts/bariol_regular-webfont.woff2',
                                    'ttf': './../fonts/bariol_regular-webfont.ttf',
                                    'eot': './../fonts/bariol_regular-webfont.eot',
                                }
                            },
                            '700': {
                                'url': {
                                    'woff': './../fonts/bariol_bold-webfont.woff',
                                    'woff2': './../fonts/bariol_bold-webfont.woff2',
                                    'ttf': './../fonts/bariol_bold-webfont.ttf',
                                    'eot': './../fonts/bariol_bold-webfont.eot',
                                }
                            }
                        },
                        'italic': {
                            '300': {
                                'url': {
                                    'woff': './../fonts/bariol_thin_italic-webfont.woff',
                                    'woff2': './../fonts/bariol_thin_italic-webfont.woff2',
                                    'ttf': './../fonts/bariol_thin_italic-webfont.ttf',
                                    'eot': './../fonts/bariol_thin_italic-webfont.eot',
                                }
                            },
                            '400': {
                                'url': {
                                    'woff': './../fonts/bariol_regular_italic-webfont.woff',
                                    'woff2': './../fonts/bariol_regular_italic-webfont.woff2',
                                    'ttf': './../fonts/bariol_regular_italic-webfont.ttf',
                                    'eot': './../fonts/bariol_regular_italic-webfont.eot',
                                }
                            },
                            '700': {
                                'url': {
                                    'woff': './../fonts/bariol_bold_italic-webfont.woff',
                                    'woff2': './../fonts/bariol_bold_italic-webfont.woff2',
                                    'ttf': './../fonts/bariol_bold_italic-webfont.ttf',
                                    'eot': './../fonts/bariol_bold_italic-webfont.eot',
                                }
                            }
                        }
                    }
                }
            }
        }
    },
};
