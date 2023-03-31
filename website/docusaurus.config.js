// @ts-check
// Note: type annotations allow type checking and IDEs autocompletion

const lightCodeTheme = require('prism-react-renderer/themes/github');
const darkCodeTheme = require('prism-react-renderer/themes/dracula');

/** @type {import('@docusaurus/types').Config} */
const config = {
    title: 'My profile',
    tagline: 'Create your resume easily from github.',
    favicon: 'img/logo_dark.svg',
    
    // Set the production url of your site here
    url: 'https://myprofile.pro',
    // Set the /<baseUrl>/ pathname under which your site is served
    // For GitHub pages deployment, it is often '/<projectName>/'
    baseUrl: '/',
    
    // GitHub pages deployment config.
    // If you aren't using GitHub pages, you don't need these.
    organizationName: 'shield-wall', // Usually your GitHub org/user name.
    projectName: 'myprofile', // Usually your repo name.
    
    onBrokenLinks: 'throw',
    onBrokenMarkdownLinks: 'warn',
    
    // Even if you don't use internalization, you can use this field to set useful
    // metadata like html lang. For example, if your site is Chinese, you may want
    // to replace "en" with "zh-Hans".
    i18n: {
        defaultLocale: 'en',
        locales: ['en'],
    },
    
    presets: [
        [
            'classic',
            // '@docusaurus/preset-classic',
            /** @type {import('@docusaurus/preset-classic').Options} */
            ({
                docs: {
                    sidebarPath: require.resolve('./sidebars.js'),
                    editUrl: 'https://github.com/shield-wall/myprofile/tree/master/website/',
                    routeBasePath: '/',
                },
                // blog: {
                //   showReadingTime: true,
                //   editUrl: 'https://github.com/shield-wall/myprofile/tree/master/website/',
                // },
                blog: false,
                theme: {
                    customCss: require.resolve('./src/css/custom.css'),
                },
            }),
        ],
    ],
    
    themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
        ({
            colorMode: {
                defaultMode: 'dark',
            },
            // Replace with your project's social card
            image: 'img/docusaurus-social-card.jpg',
            navbar: {
                title: 'My profile',
                logo: {
                    alt: 'My profile Logo',
                    src: 'img/logo.svg',
                    srcDark: 'img/logo_dark.svg',
                },
                items: [
                    // {
                    //   type: 'docSidebar',
                    //   sidebarId: 'tutorialSidebar',
                    //   position: 'left',
                    //   label: 'Documentation',
                    // },
                    // {to: '/blog', label: 'Blog', position: 'left'},
                    {
                        href: 'https://github.com/shield-wall/myprofile',
                        label: 'GitHub',
                        position: 'right',
                    },
                ],
            },
            footer: {
                style: 'dark',
                links: [
                    // {
                    //   title: 'Docs',
                    //   items: [
                    //     {
                    //       label: 'Documentation',
                    //       to: '/docs/intro',
                    //     },
                    //   ],
                    // },
                    {
                        title: 'More',
                        items: [
                            // {
                            //   label: 'Blog',
                            //   to: '/blog',
                            // },
                            {
                                label: 'GitHub',
                                href: 'https://github.com/shield-wall/myprofile',
                            },
                        ],
                    },
                ],
                // copyright: `Copyright © ${new Date().getFullYear()} My Profile, Inc. Built with Docusaurus.`,
            },
            prism: {
                theme: lightCodeTheme,
                darkTheme: darkCodeTheme,
            },
        }),
};

module.exports = config;
