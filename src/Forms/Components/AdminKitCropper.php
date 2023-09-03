<?php

namespace AdminKit\Core\Forms\Components;

use Closure;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Nuhel\FilamentCropper\Concerns\CanFlipImage;
use Nuhel\FilamentCropper\Concerns\CanGenerateThumbnail;
use Nuhel\FilamentCropper\Concerns\CanRotateImage;
use Nuhel\FilamentCropper\Concerns\CanZoomImage;
use Nuhel\FilamentCropper\Concerns\HasAspectRatio;
use Nuhel\FilamentCropper\Concerns\HasViewMode;
use Nuhel\FilamentCropper\Values\DragMode;

/**
 * This field is copied from nuhel/filament-cropper
 * See https://github.com/Nuhel/filament-cropper/blob/main/src/Components/Cropper.php
 * And only extends from SpatieMediaLibraryFileUpload
 */
class AdminKitCropper extends SpatieMediaLibraryFileUpload
{
    use CanFlipImage, CanGenerateThumbnail, CanRotateImage, CanZoomImage, HasAspectRatio, HasViewMode;

    protected string $view = 'filament-cropper::components.cropper';

    protected string|Closure|null $imageResizeTargetHeight = '720';

    protected string|Closure|null $imageResizeTargetWidth = '1080';

    protected string|Closure|null $modalSize = '2xl';

    protected string|Closure|null $modalHeading = 'Manage Image';

    protected DragMode|Closure $dragMode;

    public function getAcceptedFileTypes(): ?array
    {
        if (parent::getAcceptedFileTypes() == null) {
            $this->acceptedFileTypes([
                'image/png', ' image/gif', 'image/jpeg',
            ]);
        }

        return parent::getAcceptedFileTypes();
    }

    public function modalSize(string|Closure|null $modalSize): static
    {
        $this->modalSize = $modalSize;

        return $this;
    }

    public function getModalSize(): ?string
    {
        return $this->evaluate($this->modalSize);
    }

    public function modalHeading(string|Closure|null $modalHeading): static
    {
        $this->modalHeading = $modalHeading;

        return $this;
    }

    public function getModalHeading(): ?string
    {
        return $this->evaluate($this->modalHeading);
    }

    public function dragMode(DragMode|Closure $dragMode): static
    {
        $this->dragMode = $dragMode;

        return $this;
    }

    public function getDragMode(): DragMode
    {
        if (empty($this->dragMode)) {
            return DragMode::NONE;
        }

        return $this->evaluate($this->dragMode);
    }
}
