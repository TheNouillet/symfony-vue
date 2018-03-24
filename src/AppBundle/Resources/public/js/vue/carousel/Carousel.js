var Carousel = {
    template: "#carousel",
    delimiters: ['${', '}'],
    data: function() {
        return {
            index: 0,
            slides: []
        };
    },
    computed: {
        slidesCount: function() {
            return this.slides.length;
        }
    },
    methods: {
        prev: function() {
            this.index--;
            if(this.index < 0) {
                this.index = this.slidesCount - 1;
            }
        },
        next: function() {
            this.index++;
            if(this.index >= this.slidesCount) {
                this.index = 0;
            }
        }
    },
    mounted: function() {
        this.slides = this.$children;
        this.slides.forEach(function(slide, index) {
            slide.index = index;
        });
    }
};

Vue.component("carousel", Carousel);