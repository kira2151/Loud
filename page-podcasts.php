<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php astra_primary_content_top(); ?>

    <?php astra_content_page_loop(); ?>

    <!------ HERE STARTER MIN KODE ---->

    <template>
        <article>
            <div>
                <img src="" alt="" class="billeder">
                <h4 class="title"></h4>
            </div>
        </article>
    </template>

    <section id="primary" class="content-area">

        <nav id="filtrering"><button data-podcast="alle">Alle</button></nav>
        <main id="main" class="site-main">
            <section class="podcastcontainer">
            </section>
        </main>

        <script>
            let podcasts;
            let categories;
            let filterPodcast = "alle";

            const dbUrl = "http://kiraberthelsen.com/Loud/wp-json/wp/v2/podcast?per_page=100";
            const catUrl = "http://kiraberthelsen.com/Loud/wp-json/wp/v2/categories";


            async function getJson() {
                const data = await fetch(dbUrl);
                const catdata = await fetch(catUrl);
                podcasts = await data.json();
                categories = await catdata.json();
                console.log(categories)
                visPodcasts();
                opretknapper();
            }

            function opretknapper() {
                categories.forEach(cat => {
                    document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
                })

                addEventListenersToButtons();
            }

            function addEventListenersToButtons() {
                document.querySelectorAll("#filtrering button").forEach(elm => {
                    elm.addEventListener("click", filtrering);
                })
            };

            function filtrering() {
                filterPodcast = this.dataset.podcast;
                console.log(filterPodcast);

                visPodcasts();
            }

            //funktion der viser podcasts i liste view
            function visPodcasts() {
                let temp = document.querySelector("template");
                let container = document.querySelector(".podcastcontainer")
                container.innerHTML = "";
                podcasts.forEach(podcast => {
                    if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {
                        let klon = temp.cloneNode(true).content;
                        klon.querySelector(".title").textContent = podcast.title.rendered;
                        klon.querySelector(".billeder").src = podcast.billeder.guid;
                        klon.querySelector("article").addEventListener("click", () => {
                            location.href = podcast.link;
                        })
                        container.appendChild(klon);
                    }
                })
            }

            getJson();

        </script>
    </section>
    <!-----#primary ---->


    <!------ HERE SLUTTER MIN KODE ---->


    <?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
