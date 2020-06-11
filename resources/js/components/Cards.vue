<template>
    <div id = "holder" class = "md:ml-6">
        
        {{ height }}
        
    </div>
</template>



<script>
    import VueAxios from 'vue-axios'

    const api = '/resources/get/cards/';

    export default {
        data () {
            props: ['cards', 'links', 'width', 'height', 'length']
            /*return {
                page: 1,
                list: [],
            }*/
        },
        mounted () {
            $('.pagination').hide();
            
            var tags = [];
            function getCards(tag) 
            {
                /**
                 *  Check to see if node exists.
                 *  If exists, remove.  If not, create.
                 */

                // Set node tagDOM
                var tagDOM = document.getElementById(tag)

                // if node does not exist
                if (tagDOM === null)
                {
                    tags.push(tag)  // Push tag to tag array

                    var para = document.createElement("p")  // Create paragraph element

                    para.id = tag  // Add id to paragraph element

                    // Create text node
                    var text = tag + ' <a onclick="getCards(' + "'" + tag + "'" + ')">&times;</a>'

                    para.innerHTML = text  // Append tag text to paragraph

                    tagCrumbs.appendChild(para)  // Append tag to tagCrumbs
                }
                // if node exists
                else {
                    // Remove node 
                    tagDOM.remove()

                    // Remove tag from tags array
                    var newTags = tags.filter(item => item !== tag)

                    // Set tags to newTags
                    tags = newTags

                }

                // destroy current infinite scroll container
                $('#card-wrap').infiniteScroll('destroy')

                /**
                 *  getting the cards with AJAX
                 */
                var url = '{{ url("/resources/get/cards/$word,") }}'+tags;

                console.log(url)

                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        // put cards into #holder div
                        var holder = document.getElementById("holder")
                        holder.innerHTML = response

                        // execute infinite scroll
                        $('.pagination').hide()
                        $('#card-wrap').infiniteScroll({
                            // options
                            path: '.pagination li.active + li a',
                            append: '.card-wrapper',
                            history: false,
                        });
                    }
                }) 
            }
        },
        /*components: {
            InfiniteLoading,
        },*/
        methods: {
            myMethod() {
                this.$http.get(
                    api
                );
            }
        }
    };
</script>



<style>
    a:hover {
        cursor:pointer;
    }
</style>