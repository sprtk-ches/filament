<?php

namespace Filament\Tables\Columns;

use Filament\Forms\Components\Concerns\CanDisableOptions;
use Filament\Forms\Components\Concerns\CanDisablePlaceholderSelection;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Concerns\HasPlaceholder;
use Filament\Tables\Columns\Contracts\Editable;
use Illuminate\Validation\Rule;

class SelectColumn extends Column implements Editable
{
    use Concerns\CanBeValidated {
        getRules as baseGetRules;
    }
    use CanDisableOptions;
    use CanDisablePlaceholderSelection;
    use HasExtraInputAttributes;
    use HasOptions;
    use HasPlaceholder;

    /**
     * @var view-string
     */
    protected string $view = 'filament-tables::columns.select-column';

    protected function setUp(): void
    {
        parent::setUp();

        $this->disableClick();

        $this->placeholder(__('filament-forms::components.select.placeholder'));
    }

    public function getRules(): array
    {
        return array_merge(
            $this->baseGetRules(),
            [Rule::in(array_keys($this->getOptions()))],
        );
    }
}
