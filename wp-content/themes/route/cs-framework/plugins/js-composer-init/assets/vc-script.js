// the semi-colon before the function invocation is a safety
// net against concatenated scripts and/or other plugins
// that are not closed properly.
;(function ( $, window, document, undefined ) {
  'use strict';

  var Shortcodes = vc.shortcodes;

  if( window.VcColumnView ) {

    //
    // Carousel
    // -------------------------------------------------------------------------
    window.CSCarouselView = window.VcColumnView.extend({
      events:{
        'click > .controls .column_add':'addDirectlyElement',
        'click > .wpb_element_wrapper > .vc_empty-container':'addDirectlyElement',
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
      },
      addDirectlyElement:function ( e ) {
        e.preventDefault();
        var carousel = Shortcodes.create({shortcode:'cs_carousel_item', parent_id:this.model.id});
        return carousel;
      },
      setDropable:function () {},
      dropButton:function ( event, ui ) {},
    });

    //
    // FAQ
    // -------------------------------------------------------------------------
    window.CSFAQSView = window.VcTabsView.extend({
      events:{
        'click .add_tab':'addTab',
        'click > .vc_controls .vc_control-btn-delete':'deleteShortcode',
        'click > .vc_controls .vc_control-btn-edit':'editElement',
        'click > .vc_controls .vc_control-btn-clone':'clone'
      },
      addTab:function ( e ) {
        e.preventDefault();
        this.new_tab_adding = true;
        var tabs_count  = this.$tabs.find('[data-element_type=cs_faq_block]').length,
            tab_title   = 'FAQ ' + (tabs_count+1),
            tab_id      = (+new Date() + '-' + tabs_count + '-' + Math.floor(Math.random() * 11));

        var faq     = vc.shortcodes.create({shortcode:'cs_faq_block', params:{title:tab_title, tab_id:tab_id}, parent_id:this.model.id});
        var toggle  = vc.shortcodes.create({shortcode:'vc_toggle', params:{title:'Question', content:'Answer'}, parent_id:faq.id});
        vc.edit_element_block_view.render(toggle);
        return false;
      },
      cloneModel:function ( model, parent_id, save_order ) {
        var shortcodes_to_resort = [],
            new_order = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
            model_clone,
            tab_id,
            new_params = _.extend({}, model.get('params'));

        if ( model.get('shortcode') === 'cs_faq_block' ){
          tab_id = (+new Date() + '-' + this.$tabs.find('[data-element-type=cs_faq_block]').length + '-' + Math.floor( Math.random() * 11) );
          _.extend(new_params, {tab_id: tab_id});
        }

        model_clone = Shortcodes.create({shortcode:model.get('shortcode'), id:vc_guid(), parent_id:parent_id, order:new_order, cloned:(model.get('shortcode') === 'cs_faq_block' ? false : true), cloned_from:model.toJSON(), params:new_params});

        _.each(Shortcodes.where({parent_id:model.id}), function ( shortcode ) {
            this.cloneModel(shortcode, model_clone.get('id'), true);
        }, this);

        return model_clone;
      }
    });

    window.CSFAQView = window.VcTabView.extend({
      events:{
        'click > .vc_controls .vc_control-btn-delete':'deleteShortcode',
        'click > .vc_controls .vc_control-btn-edit':'editElement',
        'click > .vc_controls .vc_control-btn-clone':'clone',
        'click > .vc_controls .vc_control-btn-prepend':'addDirectlyElement',
        'click > .wpb_element_wrapper > .vc_empty-container':'addDirectlyElement'
      },
      addDirectlyElement:function ( e ) {
        e.preventDefault();
        var toggle = Shortcodes.create({shortcode:'vc_toggle', params:{title:'Question', content:'Answer'}, parent_id:this.model.id});
        vc.edit_element_block_view.render(toggle);
        return toggle;
      },
      setDropable:function () {},
      dropButton:function ( event, ui ) {},
      cloneModel:function ( model, parent_id, save_order ) {
        var shortcodes_to_resort  = [],
            new_order             = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
            new_params            = _.extend({}, model.get('params')),
            tab_id,
            tab_title,
            tabs_count;

        if ( model.get('shortcode') === 'cs_faq_block' ){
            tabs_count  = this.$tabs.find('[data-element_type=cs_faq_block]').length;
            tab_id      = (+new Date() + '-' + tabs_count + '-' + Math.floor(Math.random() * 11) ),
            tab_title   = 'FAQ ' + (tabs_count+1),
          _.extend(new_params, {tab_id:tab_id, title:tab_title});
        }

        var model_clone = Shortcodes.create({shortcode:model.get('shortcode'), parent_id:parent_id, order:new_order, cloned:true, cloned_from:model.toJSON(), params:new_params});

        _.each(Shortcodes.where({parent_id:model.id}), function (shortcode) {
            this.cloneModel(shortcode, model_clone.id, true);
        }, this);

        return model_clone;
      }
    });

  }

  //
  // ATTS
  // -------------------------------------------------------------------------
  _.extend(vc.atts, {
    vc_cs_exploded_textarea:{
      parse:function ( param ) {
        var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
        return $field.val().replace(/\n/g, '~');
      }
    },
    vc_cs_style_textarea:{
      parse:function ( param ) {
        var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
        return $field.val().replace(/\n/g, '');
      }
    },
    vc_cs_chosen:{
      parse:function ( param ) {
        var value = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']').val();
        return ( value ) ? value.join(',') : '';
      }
    },
  });

})( jQuery, window, document );