ElevenApp.Views.AstronautsCollection = Backbone.View.extend({

    el: $('#astronauts-collection-container'),

    initialize: function () {
        this.template = _.template($('#astronauts-collection-template').html());

        _.bindAll(this, 'render');
        this.collection.bind('change', this.render);
        this.collection.bind('add', this.render);
        this.collection.bind('remove', this.render);

    },

    render: function () {
        var renderedContent = this.template({
            astronauts: this.collection.toJSON()
        });
        $(this.el).html(renderedContent);
        return this;
    }

});