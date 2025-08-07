<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsHtmlString;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;

class Post extends Model implements HasRichContent
{
    use InteractsWithRichContent;

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentsDisk('local')
            ->fileAttachmentsVisibility('private')
            ->customBlocks([
                // HeroBlock::class,
                // HeroBlock::class => [
                //     'categoryUrl' => fn(): string => $this->category->getUrl(),
                // ],
                // CallToActionBlock::class,
            ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
