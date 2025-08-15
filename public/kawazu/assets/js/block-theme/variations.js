wp.blocks.registerBlockVariation('core/buttons', {
    name: 'custom_anchor',
    title: 'Button Anchor Link',
    icon: 'button',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_btn_anchor.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_inpage_navs',
    },
    innerBlocks: [
        ['core/button', { text: 'アンカーリンク', className: 'c_inpage_nav' }],
        ['core/button', { text: 'アンカーリンク', className: 'c_inpage_nav' }],
        ['core/button', { text: 'アンカーリンク', className: 'c_inpage_nav' }],
        [
            'core/button',
            {
                text: 'アンカーリンク長い時アンカーリンク長い時',
                className: 'c_inpage_nav',
            },
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/group', {
    name: 'custom_h2',
    title: 'H2 Heading',
    icon: 'heading',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_h2.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_heading_h2',
    },
    innerBlocks: [
        [
            'core/paragraph',
            {
                content: '00',
                className: 'u_fs_40 u_f_en c_heading_h2__numb',
            },
        ],
        [
            'core/heading',
            {
                placeholder: 'h2タイトルh2タイトル/汚泥箱',
                level: 2,
                className: 'u_fs_40 c_heading_h2__mttl',
            },
        ],
        [
            'core/paragraph',
            {
                placeholder: 'EnglishEnglishEnglish',
                className: 'u_f_en c_heading_h2__en',
            },
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/group', {
    name: 'custom_h3bg',
    title: 'H3 Heading Background White',
    icon: 'heading',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_h3bg.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_heading_h3bg c_heading_bg01',
    },
    innerBlocks: [
        [
            'core/heading',
            {
                level: 3,
                className: 'c_heading_h3bg__main',
                placeholder:
                    'h3タイトルh3タイトルh3タイトルh3タイトルh3タイトル',
            },
        ],
        [
            'core/paragraph',
            {
                className: 'c_heading_h3bg__sub',
                placeholder: 'h3サブタイトルがある時の記載',
            },
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/group', {
    name: 'custom_h3bg_gray',
    title: 'H3 Heading Background Gray',
    icon: 'heading',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_h3bg.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_heading_h3bg c_heading_bg02',
    },
    innerBlocks: [
        [
            'core/heading',
            {
                level: 3,
                className: 'c_heading_h3bg__main',
                placeholder:
                    'h3タイトルh3タイトルh3タイトルh3タイトルh3タイトル',
            },
        ],
        [
            'core/paragraph',
            {
                className: 'c_heading_h3bg__sub',
                placeholder: 'h3サブタイトルがある時の記載',
            },
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/heading', {
    name: 'custom_h3',
    title: 'H3 Heading',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_h3.png',
                },
            },
        ],
    },
    attributes: {
        placeholder:
            'コピー用見出しｈ3タイプコピー用見出しｈ3タイプコピー用見出しｈ3タイプコピー用見出しｈ3タイプ コピー用見出しｈ3タイプコピー用見出しｈ3タイプコピー用見出しｈ3タイプ',
        level: 3,
        className: 'c_heading_h3',
    },
    icon: 'heading',
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/heading', {
    name: 'custom_h4',
    title: 'H4 Heading',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_h4.png',
                },
            },
        ],
    },
    attributes: {
        level: 4,
        className: 'c_heading_h4',
        placeholder:
            'h4タイトルh4タイトルh4タイトルh4タイトルh4タイトルh4タイトル',
    },
    isDefault: false,
    scope: ['inserter'],
    icon: 'heading',
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/list', {
    name: 'custom_list',
    title: 'List',
    icon: 'editor-ul',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_list.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_txt_list',
    },
    innerBlocks: [
        [
            'core/list-item',
            {
                className: 'c_txt_list__item',
                placeholder:
                    'リストテキストリストテキストリストテキストリストテキストリストテキストリストテキストリストテキストリストテキストリストテキストリストテキストリストテキスト',
            },
        ],
        [
            'core/list-item',
            {
                className: 'c_txt_list__item',
                placeholder:
                    'リストテキストリストテキストリストテキストリストテキスト',
            },
        ],
        [
            'core/list-item',
            {
                className: 'c_txt_list__item',
                placeholder:
                    'リストテキストリストテキストリストテキストリストテキスト',
            },
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/group', {
    name: 'custom_card_groups',
    title: 'Card Groups',
    icon: 'grid-view',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_card.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_card_groups',
        layout: {
            type: 'grid',
            columns: 3,
        },
    },
    innerBlocks: [
        [
            'core/button',
            { className: 'c_card', url: '#' },
            [
                ['core/image', { className: 'c_card__thumb', url: '' }],
                [
                    'core/heading',
                    {
                        className: 'c_card__title',
                        level: 4,
                        placeholder: 'リンク見出しリンク見出し',
                    },
                ],
                [
                    'core/paragraph',
                    {
                        className: 'c_card__catch c_txt_base',
                        placeholder: '簡単な説明文が入ります...',
                    },
                ],
            ],
        ],
        [
            'core/button',
            { className: 'c_card', url: '#' },
            [
                ['core/image', { className: 'c_card__thumb', url: '' }],
                [
                    'core/heading',
                    {
                        className: 'c_card__title',
                        level: 4,
                        placeholder: 'リンク見出しリンク見出し',
                    },
                ],
                [
                    'core/paragraph',
                    {
                        className: 'c_card__catch c_txt_base',
                        placeholder: '簡単な説明文が入ります...',
                    },
                ],
            ],
        ],
        [
            'core/button',
            { className: 'c_card', url: '#' },
            [
                ['core/image', { className: 'c_card__thumb', url: '' }],
                [
                    'core/heading',
                    {
                        className: 'c_card__title',
                        level: 4,
                        placeholder: 'リンク見出しリンク見出し',
                    },
                ],
                [
                    'core/paragraph',
                    {
                        className: 'c_card__catch c_txt_base',
                        content: '簡単な説明文が入ります...',
                    },
                ],
            ],
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/group', {
    name: 'custtom_section_gradient',
    title: 'Section Gradient',
    icon: 'art',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_sec_gradient.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_section',
    },
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/group', {
    name: 'custtom_section_gray',
    title: 'Section Gray',
    icon: 'art',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_sec_gray.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_section bg_gray',
    },
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/buttons', {
    name: 'custom_btn01',
    title: 'Button 01',
    icon: 'button',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_btn01.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_buttons_group',
    },
    innerBlocks: [
        [
            'core/button',
            {
                className: 'c_btn01 c_btn',
                placeholder: 'テキストリンクパターン',
                url: '#',
            },
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});

wp.blocks.registerBlockVariation('core/buttons', {
    name: 'custom_btn02',
    title: 'Button 02',
    icon: 'button',
    example: {
        innerBlocks: [
            {
                name: 'core/image',
                attributes: {
                    url:
                        themeData.templateUrl +
                        '/assets/js/block-theme/images/img_btn02.png',
                },
            },
        ],
    },
    attributes: {
        className: 'c_buttons_group',
    },
    innerBlocks: [
        [
            'core/button',
            {
                className: 'c_btn02 c_btn',
                placeholder: 'ボタンリンクボタン',
                url: '#',
            },
        ],
    ],
    scope: ['inserter'],
    category: 'written-client',
});
