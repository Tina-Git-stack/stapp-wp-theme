/**
 * STApp Responsive Blocks — Per-Breakpoint Controls
 *
 * Adds Desktop / Tablet / Mobile settings to every block
 * via the WordPress Block Editor APIs (no build step).
 */
(function () {
    'use strict';

    var el              = wp.element.createElement;
    var Fragment        = wp.element.Fragment;
    var addFilter       = wp.hooks.addFilter;
    var createHOC       = wp.compose.createHigherOrderComponent;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody       = wp.components.PanelBody;
    var TabPanel        = wp.components.TabPanel;
    var TextControl     = wp.components.TextControl;
    var SelectControl   = wp.components.SelectControl;
    var ToggleControl   = wp.components.ToggleControl;
    var __              = wp.i18n.__;

    /* ── Default values for one breakpoint ── */
    var breakpointDefaults = {
        paddingTop:    '',
        paddingBottom: '',
        paddingLeft:   '',
        paddingRight:  '',
        marginTop:     '',
        marginBottom:  '',
        fontSize:      '',
        display:       'visible',
        maxWidth:      ''
    };

    /* ── Font-size presets from theme.json ── */
    var fontSizeOptions = [
        { label: '— Standard —', value: '' },
        { label: 'Klein (14px)',          value: '14px' },
        { label: 'Normal (16px)',         value: '16px' },
        { label: 'Mittel (20px)',         value: '20px' },
        { label: 'Groß (28px)',           value: '28px' },
        { label: 'Sehr groß (36px)',      value: '36px' },
        { label: 'XXL (3rem)',            value: '3rem' },
        { label: 'Hero (clamp)',          value: 'clamp(2.5rem, 6vw, 4.5rem)' }
    ];

    /* ── Tab definitions ── */
    var breakpointTabs = [
        { name: 'desktop', title: 'Desktop',  className: 'stapp-tab-desktop' },
        { name: 'tablet',  title: 'Tablet',   className: 'stapp-tab-tablet' },
        { name: 'mobile',  title: 'Mobil',    className: 'stapp-tab-mobile' }
    ];

    /* ───────────────────────────────────────────
       1. Register extra attributes on every block
       ─────────────────────────────────────────── */
    addFilter(
        'blocks.registerBlockType',
        'stapp/responsive-attributes',
        function (settings) {
            if (!settings.attributes) {
                settings.attributes = {};
            }
            settings.attributes.stappResponsive = {
                type: 'object',
                default: {
                    desktop: Object.assign({}, breakpointDefaults),
                    tablet:  Object.assign({}, breakpointDefaults),
                    mobile:  Object.assign({}, breakpointDefaults)
                }
            };
            return settings;
        }
    );

    /* ───────────────────────────────────────────
       2. Inspector Controls — Responsive Panel
       ─────────────────────────────────────────── */

    /**
     * Helper: returns a fresh merged responsive object after changing
     * one key inside a specific breakpoint.
     */
    function updateResponsiveValue(current, breakpoint, key, value) {
        var updated = {};
        ['desktop', 'tablet', 'mobile'].forEach(function (bp) {
            updated[bp] = Object.assign({}, breakpointDefaults, current[bp]);
        });
        updated[breakpoint] = Object.assign({}, updated[breakpoint]);
        updated[breakpoint][key] = value;
        return updated;
    }

    /**
     * Renders controls for a single breakpoint tab.
     */
    function BreakpointControls(props) {
        var bp          = props.breakpoint;
        var responsive  = props.responsive;
        var onChange     = props.onChange;
        var vals        = Object.assign({}, breakpointDefaults, responsive[bp]);

        function set(key, value) {
            onChange(updateResponsiveValue(responsive, bp, key, value));
        }

        return el('div', { className: 'stapp-responsive-controls' },

            /* — Padding — */
            el('h3', { className: 'stapp-responsive-section-title' }, __('Abstände (Padding)', 'stapp')),
            el('div', { className: 'stapp-responsive-grid' },
                el(TextControl, { label: __('Oben', 'stapp'),   value: vals.paddingTop,    onChange: function (v) { set('paddingTop', v); } }),
                el(TextControl, { label: __('Unten', 'stapp'),  value: vals.paddingBottom, onChange: function (v) { set('paddingBottom', v); } }),
                el(TextControl, { label: __('Links', 'stapp'),  value: vals.paddingLeft,   onChange: function (v) { set('paddingLeft', v); } }),
                el(TextControl, { label: __('Rechts', 'stapp'), value: vals.paddingRight,  onChange: function (v) { set('paddingRight', v); } })
            ),

            /* — Margin — */
            el('h3', { className: 'stapp-responsive-section-title' }, __('Abstände (Margin)', 'stapp')),
            el('div', { className: 'stapp-responsive-grid stapp-responsive-grid--2' },
                el(TextControl, { label: __('Oben', 'stapp'),  value: vals.marginTop,    onChange: function (v) { set('marginTop', v); } }),
                el(TextControl, { label: __('Unten', 'stapp'), value: vals.marginBottom, onChange: function (v) { set('marginBottom', v); } })
            ),

            /* — Font Size — */
            el(SelectControl, {
                label:    __('Schriftgröße', 'stapp'),
                value:    vals.fontSize,
                options:  fontSizeOptions,
                onChange: function (v) { set('fontSize', v); }
            }),

            /* — Max Width — */
            el(TextControl, {
                label:    __('Max-Breite', 'stapp'),
                help:     __('z. B. 600px, 80%, 40rem', 'stapp'),
                value:    vals.maxWidth,
                onChange: function (v) { set('maxWidth', v); }
            }),

            /* — Visibility — */
            el(ToggleControl, {
                label:    __('Auf diesem Gerät ausblenden', 'stapp'),
                checked:  vals.display === 'hidden',
                onChange: function (v) { set('display', v ? 'hidden' : 'visible'); }
            })
        );
    }

    var withResponsiveControls = createHOC(function (BlockEdit) {
        return function (props) {
            var attributes    = props.attributes;
            var setAttributes = props.setAttributes;
            var responsive    = Object.assign(
                { desktop: {}, tablet: {}, mobile: {} },
                attributes.stappResponsive
            );

            function onChangeResponsive(newVal) {
                setAttributes({ stappResponsive: newVal });
            }

            return el(Fragment, {},
                el(BlockEdit, props),
                el(InspectorControls, {},
                    el(PanelBody, {
                        title:       __('Responsive Einstellungen', 'stapp'),
                        initialOpen: false,
                        className:   'stapp-responsive-panel'
                    },
                        el(TabPanel, {
                            className:        'stapp-responsive-tabs',
                            activeClass:      'is-active',
                            tabs:             breakpointTabs
                        }, function (tab) {
                            return el(BreakpointControls, {
                                breakpoint: tab.name,
                                responsive: responsive,
                                onChange:   onChangeResponsive
                            });
                        })
                    )
                )
            );
        };
    }, 'withResponsiveControls');

    addFilter(
        'editor.BlockEdit',
        'stapp/responsive-controls',
        withResponsiveControls
    );

    /* ───────────────────────────────────────────
       3. BlockListBlock — add data attribute for
          optional editor-preview styling
       ─────────────────────────────────────────── */
    var withResponsiveDataAttr = createHOC(function (BlockListBlock) {
        return function (props) {
            var responsive = props.attributes && props.attributes.stappResponsive;
            var extra      = {};

            if (responsive) {
                var hasValues = ['desktop', 'tablet', 'mobile'].some(function (bp) {
                    var vals = responsive[bp];
                    if (!vals) return false;
                    return Object.keys(vals).some(function (k) {
                        return vals[k] !== '' && vals[k] !== 'visible';
                    });
                });
                if (hasValues) {
                    extra['data-stapp-responsive'] = 'true';
                }
            }

            return el(BlockListBlock, Object.assign({}, props, { wrapperProps: Object.assign({}, props.wrapperProps, extra) }));
        };
    }, 'withResponsiveDataAttr');

    addFilter(
        'editor.BlockListBlock',
        'stapp/responsive-data-attr',
        withResponsiveDataAttr
    );

})();
