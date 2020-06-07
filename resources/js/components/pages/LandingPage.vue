<template>
    <div id = "landing">
        <div class = "hero">
            <img src = "/img/flippedbook.svg" />
            <h1>The Future of Learning</h1>
            <div class = "content">
                <p>Bringing together the best of the best in education.</p>
            </div>
        </div>
        <!-- SVG Waves from https://www.shapedivider.app/ -->
        <div class="custom-shape-divider-bottom-1591391235">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39 56.44c58-10.79 114.16-30.13 172-41.86 82.39-16.72 168.19-17.73 250.45-.39C823.78 31 906.67 72 985.66 92.83c70.05 18.48 146.53 26.09 214.34 3V0H0v27.35a600.21 600.21 0 00321.39 29.09z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
</template>

<script>
    export default {}
</script>

<style lang="scss">
    @import '../../../sass/_variables.scss';
    @import '../../../sass/_base.scss';
    @import '../../../sass/_typography.scss';
    
    #landing {
        @apply relative h-screen bg-dark2 bg-fixed bg-cover text-white mt-4;
        
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1200 800'%3E%3Cdefs%3E%3CradialGradient id='a' cx='0' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%233d1c8b'/%3E%3Cstop offset='1' stop-color='%233d1c8b' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='b' cx='1200' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%236e43a9'/%3E%3Cstop offset='1' stop-color='%236e43a9' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='c' cx='600' cy='0' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%232945c2'/%3E%3Cstop offset='1' stop-color='%232945c2' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='d' cx='600' cy='800' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23712f79'/%3E%3Cstop offset='1' stop-color='%23712f79' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='e' cx='0' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%230a369d'/%3E%3Cstop offset='1' stop-color='%230a369d' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='f' cx='1200' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%236d72c3'/%3E%3Cstop offset='1' stop-color='%236d72c3' stop-opacity='0'/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='1200' height='800'/%3E%3Crect fill='url(%23b)' width='1200' height='800'/%3E%3Crect fill='url(%23c)' width='1200' height='800'/%3E%3Crect fill='url(%23d)' width='1200' height='800'/%3E%3Crect fill='url(%23e)' width='1200' height='800'/%3E%3Crect fill='url(%23f)' width='1200' height='800'/%3E%3C/svg%3E");
        
        .hero {
            @extend %main;
            
            img {
                margin: 0 auto;
                @apply w-64 mt-6;
            }
            h1 {
                @apply text-center text-5xl mt-6;
            }
            .content {
                @apply w-1/2;
                margin: 0 auto;
                
                p {
                    @apply text-lg text-center;
                }
            }
        }
    }
    
    /* SVG Waves from https://www.shapedivider.app/ */
    .custom-shape-divider-bottom-1591391235 {
        @apply absolute bottom-0 inset-x-0 w-full overflow-hidden;
        line-height: 0;
        transform: rotate(180deg);
    }
    .custom-shape-divider-bottom-1591391235 svg {
        @apply relative block;
        width: calc(137% + 1.3px);
        height: 110px;
    }
    .custom-shape-divider-bottom-1591391235 .shape-fill {
        fill: #FFFFFF;
    }
</style>