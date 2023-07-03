<?php

namespace App\Tables;

use App\Models\Subscription;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Subscriptions extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Subscription::query()
            ->with('videos')
            ->withCount('videos')
            ->withSum('videos', 'size');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['title'])
            ->column('title', sortable: true)
            ->column('videos_count', label: 'Videos', sortable: true)
            ->column('videos.size', label: 'Size', sortable: true, as: function ($size) {
                $size = (int) $size ?? 0;

                for ($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {
                }

                return round($size, 2).['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'][$i];
            })
            ->bulkAction('Delete', function (Subscription $subscription) {
                $subscription->delete();
            });
    }
}
