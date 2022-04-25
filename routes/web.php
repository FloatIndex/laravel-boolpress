<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// www.miosito.it/login viene gestito da
Auth::routes();

// www.miosito.it/admin/* viene gestito da
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('posts', 'PostController');

        Route::resource('tags', 'TagController');
    });

/** www.miosito.it/qualsiasi-rotta-non-precedentemente-definita viene gestito da... */
Route::get('{any?}', function() {
    return view('guests.home');
})->where('any', '.*');
/** ...che restituisce la vista home (contenuta nella cartella guests), al cui interno
 * è presente l'istanza di vue (e lo script js). Qualsiasi rotta diversa da login e admin quindi riguarderà
 * il frontend, cioè verrà gestita dal sistema di routing di vue. Laravel si ferma qui.
 * A questo punto quindi vue legge l'URI qualsiasi-rotta-non-precedentemente-definita e attraverso front.js,
 * controlla se è definito in router.js (router.js è importanto in front.js); se l'URI è definito allora
 * renderizza il relativo componente nella parte variabile del sito (main, router-view), altrimenti renderizzerà
 * la parte variabile vuota, priva di contenuti (a meno che non venga definita una pagina d'errore da mostrare in
 * caso di URI non esistenti).
 * 
 * GIRO DI DATI in Vue quando viene richiesta una rotta frontend:
 * - front.js renderizza App.vue
 * - App.vue richiama il componente Main
 * - Main.vue renderizza il componente router-view
 * - router.js renderizza dentro router-view i componenti definiti nelle sue rotte
 * Quindi App conterrà la struttura monolitica del sito costituita per esempio da Header, Main e Footer. Main invece contiene il componente router-view che renderizza le single pages (elenco post, about, contatti,…)
 */