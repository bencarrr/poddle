<?php

namespace PhanAn\Poddle\Values;

use Illuminate\Support\Arr;

class Channel extends Serializable
{
    final public function __construct(
        public readonly string $url,
        public readonly string $title,
        public readonly string $description,
        public readonly string $language,
        public readonly CategoryCollection $categories,
        public readonly bool $explicit,
        public readonly string $image,
        public readonly ChannelMetadata $metadata,
        public readonly ?string $link = null,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            url: Arr::get($data, 'url'),
            title: Arr::get($data, 'title'),
            description: Arr::get($data, 'description'),
            language: Arr::get($data, 'language'),
            categories: CategoryCollection::fromArray(Arr::get($data, 'categories', [])),
            explicit: Arr::get($data, 'explicit', false),
            image: Arr::get($data, 'image'),
            metadata: ChannelMetadata::fromArray(Arr::get($data, 'metadata', [])),
            link: Arr::get($data, 'link'),
        );
    }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
            'language' => $this->language,
            'categories' => $this->categories->toArray(),
            'explicit' => $this->explicit,
            'image' => $this->image,
            'metadata' => $this->metadata->toArray(),
        ];
    }
}
