<style>
:root {
    --primary-color: {{ $primary_color }};
    --secondary-color: {{ $secondary_color }};
}
/*body {
    background-color: var(--primary-color);
}*/

#header-top-area {
	background: var(--primary-color);
}

#menu-area {
	background: var(--primary-color);
}

.offer {
	background: var(--primary-color);
}

.category-title {
	border-bottom: 2px solid var(--primary-color);
}

.product-content span#price{
	color: var(--primary-color);
}

.form-inline button{
	background: var(--primary-color);
	color:#fff;
}

.form-inline button:hover {
	color: var(--secondary-color);
	text-decoration: none;
}

</style>