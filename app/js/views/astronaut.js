ElevenApp.Views.Astronaut = Backbone.View.extend({
    el: $('#astronaut-container'),
    initialize: function () {
        this.template = _.template($('#astronaut-template').html());

        _.bindAll(this, 'render');
        this.model.bind('change', this.render);
    },

    setModel: function (model) {
        this.model = model;
        return this;
    },

    render: function () {
        var renderedContent = this.template(this.model.toJSON());
        $(this.el).html(renderedContent);
        return this;
    }

});