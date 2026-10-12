<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\PageItem;
use App\Models\PageText;

/**
 * One place in the admin for everything on the Applications page.
 * The content itself is edited in the shared modules (Page Content, FAQs, Page Texts);
 * this screen only groups the shortcuts and shows how much content each block has.
 */
class ApplicationPageController extends Controller
{
    public function index()
    {
        $blocks = [
            [
                'title' => 'Application Cards',
                'text'  => 'The 18 industry cards (image, title, description) in "Supporting Dynamic Infrastructure Worldwide".',
                'count' => PageItem::where('section', 'applications.items')->count(),
                'icon'  => 'icofont-layout',
                'list'  => route('page-items.index', ['section' => 'applications.items']),
                'add'   => route('page-items.create', ['section' => 'applications.items']),
            ],
            [
                'title' => 'Why Ratnadeep (numbered cards)',
                'text'  => 'The four numbered cards under "Manufacturing That Matches Your Application".',
                'count' => PageItem::where('section', 'applications.reasons')->count(),
                'icon'  => 'icofont-listing-number',
                'list'  => route('page-items.index', ['section' => 'applications.reasons']),
                'add'   => route('page-items.create', ['section' => 'applications.reasons']),
            ],
            [
                'title' => 'FAQs',
                'text'  => 'Questions and answers at the bottom of the page.',
                'count' => Faq::where('page', 'applications')->count(),
                'icon'  => 'icofont-question-circle',
                'list'  => route('faqs.index', ['page' => 'applications']),
                'add'   => route('faqs.create', ['page' => 'applications']),
            ],
            [
                'title' => 'Page Texts & Hero Banner',
                'text'  => 'Hero banner image, headings, paragraphs and button labels of the page.',
                'count' => PageText::where('page', 'applications')->count(),
                'count_label' => 'edited',
                'icon'  => 'icofont-edit-alt',
                'list'  => route('page-texts.edit', 'applications'),
                'add'   => null,
            ],
        ];

        return view('admin.applications.index', compact('blocks'));
    }
}
