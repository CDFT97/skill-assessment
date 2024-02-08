<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteStoreRequest;
use App\Models\Quote;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Repositories\QuoteRepository;
use App\Services\DummyQuotesService;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class QuoteController extends Controller
{
    protected $dummyQuoteService;
    protected $quoteRepository;

    public function __construct(DummyQuotesService $dummyQuoteService, QuoteRepository $quoteRepository)
    {
        $this->dummyQuoteService = $dummyQuoteService;
        $this->quoteRepository = $quoteRepository;
    }

    public function fiveRandom()
    {
        $res_from_api = $this->dummyQuoteService->getRandomQuotes();
        $quotes = $res_from_api->quotes;
        $fav_quotes_id_list = $this->quoteRepository->getIdListByUserId(auth()->id());

        if(request()->wantsJson()) {
            return response()->json($quotes, Response::HTTP_OK);
        }

        return Inertia::render('Quotes/FiveRandom', compact('quotes', 'fav_quotes_id_list'));
    }

    public function store(QuoteStoreRequest $request)
    {
        $data = $request->validated();

        $quote = new Quote();
        $quote->author = $data['author'];
        $quote->quote = $data['quote'];
        $quote->external_id = $data['id'];
        $quote->user_id = auth()->id();

        $this->quoteRepository->save($quote);

        if($request->wantsJson()) {
            return response()->json($quote, Response::HTTP_CREATED);
        }

        return redirect()->back();
    }
}
