var CarouselSlide = {
    template: "#carousel-slide",
    delimiters: ['${', '}'],
    data: function() {
        return {
            index: 0
        }
    },
    computed: {
        visible: function() {
            return this.index == this.$parent.index;
        }
    }
};

Vue.component("carousel-slide", CarouselSlide);