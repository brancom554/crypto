<!-- ./Forms Components -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row">
        <div class="col-md-6">
            <!-- Basic form inputs -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Basic form inputs</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="cozy">
                        <div class="form-group">
                            <label for="exampleInputEmailBase" class="form-label mb-0">Email address</label>
                            <div id="emailHelp" class="form-text text-secondary mt-0 mb-2">We'll never share your email with anyone else.</div>
                            <input type="email" class="form-control" id="exampleInputEmailBase" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPasswordBase" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPasswordBase" placeholder="Password">
                        </div>

                        <div class="form-group checkbox">
                            <input type="checkbox" class="form-check-input" id="exampleCheckBase">
                            <label class="form-check-label" for="exampleCheckBase">Check me out</label>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelectMultipleBase">Example select</label>
                            <select class="form-select" id="exampleFormControlSelectMultipleBase">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextareaBase">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextareaBase" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Rounded inputs -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Rounded inputs</h5>
                </div>
                <div class="card-body">
                    <form action=";" class="cozy">
                        <div class="form-group">
                            <label for="exampleInputEmailRounded" class="form-label mb-0">Email address</label>
                            <div id="emailHelp" class="form-text text-muted mt-0 mb-2">We'll never share your email with anyone else.</div>
                            <input type="email" class="form-control form-control-rounded" id="exampleInputEmailRounded" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPasswordRounded" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-rounded" id="exampleInputPasswordRounded" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelectMultipleRounded" class="form-label">Example select</label>
                            <select class="form-select form-control-rounded" id="exampleFormControlSelectMultipleRounded">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelectRounded" class="form-label">Example multiple select</label>
                            <select multiple="multiple" class="form-select form-control-rounded" id="exampleFormControlSelectRounded">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextareaRounded" class="form-label">Example textarea</label>
                            <textarea class="form-control form-control-rounded" id="exampleFormControlTextareaRounded" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Inputs with icons -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Inputs with icons</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="cozy">
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Default inputs</legend>
                            <div class="form-group has-icon">
                                <input type="text" id="exampleInputIconRight" class="form-control" placeholder="Right icon">
                                <i class="icon fas fa-user"></i>
                            </div>
                            <div class="form-group has-icon icon-left">
                                <input type="text" id="exampleInputIconLeft" class="form-control" placeholder="Left icon">
                                <i class="icon fas fa-user"></i>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Rounded inputs</legend>
                            <div class="form-group has-icon">
                                <input type="text" id="exampleInputIconRightRounded" class="form-control form-control-rounded" placeholder="Right icon">
                                <i class="icon fas fa-user"></i>
                            </div>
                            <div class="form-group has-icon icon-left">
                                <input type="text" id="exampleInputIconLeftRounded" class="form-control form-control-rounded" placeholder="Left icon">
                                <i class="icon fas fa-user"></i>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Sizing inputs</legend>
                            <div class="form-group has-icon">
                                <input type="text" id="exampleInputIconRightLg" class="form-control form-control-lg" placeholder="Right icon - input large">
                                <i class="icon fas fa-user"></i>
                            </div>
                            <div class="form-group has-icon icon-left">
                                <input type="text" id="exampleInputIconLeftSm" class="form-control form-control-sm" placeholder="Left icon - input small">
                                <i class="icon fas fa-user"></i>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Animation icons</legend>
                            <div class="form-group has-icon icon-left">
                                <input type="text" id="exampleInputIconLeftAnimated" class="form-control" placeholder="Left icon - fa-sync fa-spin">
                                <i class="icon fas fa-sync fa-spin"></i>
                            </div>
                            <div class="form-group has-icon icon-left">
                                <input type="text" id="exampleInputIconLeftAnimated2" class="form-control" placeholder="Left icon - fa-spinner fa-pulse">
                                <i class="icon fas fa-spinner fa-pulse"></i>
                            </div>
                            <div class="form-group has-icon">
                                <input type="text" id="exampleInputIconRightAnimated" class="form-control" placeholder="Right icon - fa-sync fa-spin">
                                <i class="icon fas fa-sync fa-spin"></i>
                            </div>
                            <div class="form-group has-icon">
                                <input type="text" id="exampleInputIconRightAnimated2" class="form-control" placeholder="Right icon - fa-spinner fa-pulse">
                                <i class="icon fas fa-spinner fa-pulse"></i>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- Text options -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast d-flex flex-column flex-md-row">
                    <h5 class="bold">Text options</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="form cozy">
                        <div class="form-group">
                            <label for="exampleInputThin" class="form-label">Input with thin font</label>
                            <input type="text" class="form-control thin" id="exampleInputThin" placeholder="Input with thin font" value="Input with thin font">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputLight" class="form-label">Input with light font</label>
                            <input type="text" class="form-control light" id="exampleInputLight" placeholder="Input with light font" value="Input with light font">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputRegular" class="form-label">Input with regular font</label>
                            <input type="text" class="form-control regular" id="exampleInputRegular" placeholder="Input with regular font" value="Input with regular font">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputBold" class="form-label">Input with bold font</label>
                            <input type="text" class="form-control bold" id="exampleInputBold" placeholder="Input with bold font" value="Input with bold font">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputExtraBold" class="form-label">Input with bold font</label>
                            <input type="text" class="form-control extra-bold" id="exampleInputExtraBold" placeholder="Input with extra-bold font" value="Input with extra-bold font">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputCapitalized" class="form-label">Input with bold font</label>
                            <input type="text" class="form-control text-capitalize" id="exampleInputCapitalized" placeholder="Input with capitalized text" value="Input with capitalized text">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputUpperCase" class="form-label">Input with upper case</label>
                            <input type="text" class="form-control text-uppercase" id="exampleInputUpperCase" placeholder="Input with upper case" value="Input with upper case text">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputTextCenter" class="form-label">Input with centered text</label>
                            <input type="text" class="form-control text-center" id="exampleInputTextCenter" placeholder="Input with centered text" value="Input with centered text">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputTextRight" class="form-label">Input with right aligned text</label>
                            <input type="text" class="form-control text-end" id="exampleInputTextRight" placeholder="Input with right aligned text" value="Input with right aligned text">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Validation States -->
            <div class="card mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Validation states</h5>
                </div>

                <div class="card-body">
                    <!-- When specifying data-states="true" then the valid css class 'is-valid' is appended to every form input when it's valid -->
                    <form action=";" class="cozy" data-states="true">
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Default inputs</legend>
                            <div class="form-group">
                                <input type="text" id="exampleInputIconRight2" class="form-control is-valid" placeholder="Valid state">
                                <small class="form-text text-success">Valid state helper</small>
                            </div>

                            <div class="form-group">
                                <input type="text" id="exampleInputIconLeft2" class="form-control is-invalid" placeholder="Invalid state">
                                <small class="form-text text-danger">Invalid state helper</small>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Rounded inputs</legend>
                            <div class="form-group">
                                <input type="text" id="exampleInputIconRightRounded2" class="form-control form-control-rounded is-valid" placeholder="Valid state">
                            </div>

                            <div class="form-group">
                                <input type="text" id="exampleInputIconLeftRounded2" class="form-control form-control-rounded is-invalid" placeholder="Invalid state">
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Inputs with icon</legend>
                            <div class="form-group has-icon icon-left">
                                <input type="text" id="exampleInputIconRightLg2" class="form-control is-valid" placeholder="Valid state">
                                <i class="icon fas fa-envelope"></i>
                            </div>

                            <div class="form-group has-icon icon-left">
                                <input type="text" id="exampleInputIconLeftSm2" class="form-control is-invalid" placeholder="Invalid state">
                                <i class="icon fas fa-envelope"></i>
                            </div>

                            <label class="form-label mb-0">Live sample</label>
                            <div class="form-text mb-2 mt-0">Enter a valid email address... or not</div>
                            <div class="form-group has-icon icon-left">
                                <input type="email" id="exampleInputIconLeftLive" class="form-control" placeholder="Live sample. Enter a valid email address... or not">
                                <i class="icon fas fa-envelope"></i>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- Sizing Options -->
            <div class="card card-clean shadow-box">
                <div class="card-header bg-contrast d-flex flex-column flex-md-row">
                    <h5 class="bold">Sizing options</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="form cozy">
                        <fieldset>
                            <legend class="bold small text-uppercase text-primary">Input elements</legend>
                            <div class="form-group">
                                <label for="exampleInputLarge" class="form-label">Large input</label>
                                <input type="text" class="form-control form-control-lg" id="exampleInputLarge" placeholder="Large input">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputDefault" class="form-label">Default input</label>
                                <input type="text" class="form-control" id="exampleInputDefault" placeholder="Default input">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputSmall" class="form-label">Small input</label>
                                <input type="text" class="form-control form-control-sm" id="exampleInputSmall" placeholder="Default input">
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="bold small text-uppercase text-primary">Select inputs</legend>
                            <div class="form-group">
                                <label for="exampleSelectLarge" class="form-label">Large select</label>
                                <select type="text" class="form-select form-control-lg" id="exampleSelectLarge">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectDefault" class="form-label">Default select</label>
                                <select type="text" class="form-select form-control-sm" id="exampleSelectDefault">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectSmall" class="form-label">Small select</label>
                                <select type="text" class="form-select form-control-sm" id="exampleSelectSmall">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Checkboxes -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold mb-0">Checkboxes</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="cozy">
                        <!-- Checkboxes: Default unstyled -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Default unstyled</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div>
                                        <input type="checkbox" value="" id="defaultCheck1">
                                        <label for="defaultCheck1">Default checkbox</label>
                                    </div>

                                    <div>
                                        <input type="checkbox" value="" id="defaultCheck2" disabled="disabled">
                                        <label for="defaultCheck2">Disabled checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Checkboxes: Inline -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Inline</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">1</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">2</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled="disabled">
                                        <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Checkboxes: Bootstrap custom -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Bootstrap custom</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">Check this custom checkbox</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="customCheck2">
                                        <label class="form-check-label" for="customCheck2">Check this custom checkbox</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="customCheckDisabled" value="option3" disabled>
                                        <label class="form-check-label" for="customCheckDisabled">Check this (disabled) checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- Styled Checkboxes -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">DashCore Styled Checkboxes</h5>
                </div>
                <div class="card-body">
                    <form action=";" class="cozy">
                        <!-- Checkboxes: Default style -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Default style</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="checkbox">
                                        <input type="checkbox" id="exampleCheckStyled1">
                                        <label for="exampleCheckStyled1">Check me out</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" id="exampleCheckStyled2">
                                        <label for="exampleCheckStyled2">Check me out</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Checkboxes:Inline -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Inline</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="checkbox form-check-inline checkbox-inline">
                                        <input type="checkbox" id="exampleCheckInlineStyled1">
                                        <label for="exampleCheckInlineStyled1">1</label>
                                    </div>
                                    <div class="checkbox form-check-inline checkbox-inline">
                                        <input type="checkbox" id="exampleCheckInlineStyled2">
                                        <label for="exampleCheckInlineStyled2">2</label>
                                    </div>
                                    <div class="checkbox form-check-inline checkbox-inline">
                                        <input type="checkbox" id="exampleCheckInlineStyled3" disabled="disabled">
                                        <label for="exampleCheckInlineStyled3">3 (disabled)</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Checkboxes:Checked Color -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Checked color</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="checkbox checkbox-dark">
                                                <input type="checkbox" id="exampleCheckColorStyledDark">
                                                <label for="exampleCheckColorStyledDark">Style Dark</label>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input type="checkbox" id="exampleCheckColorStyledPrimary">
                                                <label for="exampleCheckColorStyledPrimary">Style Primary</label>
                                            </div>
                                            <div class="checkbox checkbox-alternate">
                                                <input type="checkbox" id="exampleCheckColorStyledAlternate">
                                                <label for="exampleCheckColorStyledAlternate">Style Alternate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" id="exampleCheckColorStyledSuccess">
                                                <label for="exampleCheckColorStyledSuccess">Style Success</label>
                                            </div>
                                            <div class="checkbox checkbox-warning">
                                                <input type="checkbox" id="exampleCheckColorStyledWarning">
                                                <label for="exampleCheckColorStyledWarning">Style Warning</label>
                                            </div>
                                            <div class="checkbox checkbox-danger">
                                                <input type="checkbox" id="exampleCheckColorStyledDanger">
                                                <label for="exampleCheckColorStyledDanger">Style Danger</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Checkboxes:Outlined Style -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Outlined Style</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="checkbox checkbox-dark checkbox-outlined">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedDark">
                                                <label for="exampleCheckColorStyledOutlinedDark">Style Dark</label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-outlined">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedPrimary">
                                                <label for="exampleCheckColorStyledOutlinedPrimary">Style Primary</label>
                                            </div>
                                            <div class="checkbox checkbox-alternate checkbox-outlined">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedAlternate">
                                                <label for="exampleCheckColorStyledOutlinedAlternate">Style Alternate</label>
                                            </div>
                                            <hr>
                                            <div class="checkbox checkbox-primary checkbox-outlined bw-2">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedBw3">
                                                <label for="exampleCheckColorStyledOutlinedBw3">Border 2x</label>
                                            </div>
                                            <div class="checkbox checkbox-alternate checkbox-outlined bw-2">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedBw4">
                                                <label for="exampleCheckColorStyledOutlinedBw4">Border 2x</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="checkbox checkbox-success checkbox-outlined">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedSuccess">
                                                <label for="exampleCheckColorStyledOutlinedSuccess">Style Success</label>
                                            </div>
                                            <div class="checkbox checkbox-warning checkbox-outlined">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedWarning">
                                                <label for="exampleCheckColorStyledOutlinedWarning">Style Warning</label>
                                            </div>
                                            <div class="checkbox checkbox-danger checkbox-outlined">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedDanger">
                                                <label for="exampleCheckColorStyledOutlinedDanger">Style Danger</label>
                                            </div>
                                            <hr>
                                            <div class="checkbox checkbox-warning checkbox-outlined bw-2">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedWarningBw">
                                                <label for="exampleCheckColorStyledOutlinedWarningBw">Border 2x</label>
                                            </div>
                                            <div class="checkbox checkbox-danger checkbox-outlined bw-2">
                                                <input type="checkbox" id="exampleCheckColorStyledOutlinedDangerBw">
                                                <label for="exampleCheckColorStyledOutlinedDangerBw">Border 2x</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Checkboxes:Solid Style -->
                        <fieldset>
                            <legend class="bold small text-uppercase">Solid Style</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="checkbox checkbox-dark checkbox-solid">
                                                <input type="checkbox" id="exampleCheckColorStyledSolidDark">
                                                <label for="exampleCheckColorStyledSolidDark">Style Dark</label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-solid">
                                                <input type="checkbox" id="exampleCheckColorStyledSolidPrimary">
                                                <label for="exampleCheckColorStyledSolidPrimary">Style Primary</label>
                                            </div>
                                            <div class="checkbox checkbox-alternate checkbox-solid">
                                                <input type="checkbox" id="exampleCheckColorStyledSolidAlternate">
                                                <label for="exampleCheckColorStyledSolidAlternate">Style Alternate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="checkbox checkbox-success checkbox-solid">
                                                <input type="checkbox" id="exampleCheckColorStyledSolidSuccess">
                                                <label for="exampleCheckColorStyledSolidSuccess">Style Success</label>
                                            </div>
                                            <div class="checkbox checkbox-warning checkbox-solid">
                                                <input type="checkbox" id="exampleCheckColorStyledSolidWarning">
                                                <label for="exampleCheckColorStyledSolidWarning">Style Warning</label>
                                            </div>
                                            <div class="checkbox checkbox-danger checkbox-solid">
                                                <input type="checkbox" id="exampleCheckColorStyledSolidDanger">
                                                <label for="exampleCheckColorStyledSolidDanger">Style Danger</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- Radios -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="Bold">Radios</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="cozy">
                        <!-- Radios: Unstyled -->
                        <fieldset>
                            <legend class="small bold text-uppercase text-dark">Default unstyled</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div>
                                        <input type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked="checked">
                                        <label for="exampleRadios1">Default radio</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label for="exampleRadios2">Second default radio</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled="disabled">
                                        <label for="exampleRadios3">Disabled radio</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Radios: Inline -->
                        <fieldset>
                            <legend class="small bold text-uppercase text-dark">Inline</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled="disabled">
                                        <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Radios: Bootstrap -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Bootstrap custom</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="form-check">
                                        <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                        <label class="form-check-label" for="customRadio1">Toggle this custom radio</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                        <label class="form-check-label" for="customRadio2">Or toggle this other custom radio</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="customRadioDisabled" name="customRadio" class="form-check-input" disabled="disabled">
                                        <label class="form-check-label" for="customRadioDisabled">Toggle this (disabled) radio</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- Styled Radios -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Styled Radios</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="cozy">
                        <!-- Styled Radios: Default Style -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Default style</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="radio">
                                        <input type="radio" id="exampleRadioStyled1" name="defaultStyleRadio">
                                        <label for="exampleRadioStyled1">Check me out</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" id="exampleRadioStyled2" name="defaultStyleRadio">
                                        <label for="exampleRadioStyled2">Check me out</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Styled Radios: Inline -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Inline</legend>
                            <div class="form-group">
                                <div class="form-check-list">
                                    <div class="radio form-check-inline radio-inline">
                                        <input type="radio" id="exampleRadioInlineStyled1" name="inlineStyleRadio">
                                        <label for="exampleRadioInlineStyled1">1</label>
                                    </div>
                                    <div class="radio form-check-inline radio-inline">
                                        <input type="radio" id="exampleRadioInlineStyled2" name="inlineStyleRadio">
                                        <label for="exampleRadioInlineStyled2">2</label>
                                    </div>
                                    <div class="radio form-check-inline radio-inline">
                                        <input type="radio" id="exampleRadioInlineStyled3" name="inlineStyleRadio" disabled="disabled">
                                        <label for="exampleRadioInlineStyled3">3 (disabled)</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Styled Radios: Checked Color -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Checked color</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="radio radio-dark">
                                                <input type="radio" id="exampleRadioColorStyledDark" name="colorCheckStyleRadio">
                                                <label for="exampleRadioColorStyledDark">Style Dark</label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input type="radio" id="exampleRadioColorStyledPrimary" name="colorCheckStyleRadio">
                                                <label for="exampleRadioColorStyledPrimary">Style Primary</label>
                                            </div>
                                            <div class="radio radio-alternate">
                                                <input type="radio" id="exampleRadioColorStyledAlternate" name="colorCheckStyleRadio">
                                                <label for="exampleRadioColorStyledAlternate">Style Alternate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="radio radio-success">
                                                <input type="radio" id="exampleRadioColorStyledSuccess" name="colorCheckStyleRadio2">
                                                <label for="exampleRadioColorStyledSuccess">Style Success</label>
                                            </div>
                                            <div class="radio radio-warning">
                                                <input type="radio" id="exampleRadioColorStyledWarning" name="colorCheckStyleRadio2">
                                                <label for="exampleRadioColorStyledWarning">Style Warning</label>
                                            </div>
                                            <div class="radio radio-danger">
                                                <input type="radio" id="exampleRadioColorStyledDanger" name="colorCheckStyleRadio2">
                                                <label for="exampleRadioColorStyledDanger">Style Danger</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Styled Radios: Outlined Style -->
                        <fieldset>
                            <legend class="bold small text-uppercase text-dark">Outlined Style</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="radio radio-muted radio-outlined">
                                                <input type="radio" id="exampleRadioColorStyledOutlined2" name="colorOutlineStyleRadio">
                                                <label for="exampleRadioColorStyledOutlined2">Style 2</label>
                                            </div>
                                            <div class="radio radio-primary radio-outlined">
                                                <input type="radio" id="exampleRadioColorStyledOutlined3" name="colorOutlineStyleRadio">
                                                <label for="exampleRadioColorStyledOutlined3">Style 3</label>
                                            </div>
                                            <div class="radio radio-alternate radio-outlined">
                                                <input type="radio" id="exampleRadioColorStyledOutlined4" name="colorOutlineStyleRadio">
                                                <label for="exampleRadioColorStyledOutlined4">Style 4</label>
                                            </div>
                                            <hr>
                                            <div class="radio radio-primary radio-outlined bw-2">
                                                <input type="radio" id="exampleRadioColorStyledOutlinedBw3" name="colorOutlineStyleRadio">
                                                <label for="exampleRadioColorStyledOutlinedBw3">Border 2x</label>
                                            </div>
                                            <div class="radio radio-alternate radio-outlined bw-2">
                                                <input type="radio" id="exampleRadioColorStyledOutlinedBw4" name="colorOutlineStyleRadio">
                                                <label for="exampleRadioColorStyledOutlinedBw4">Border 2x</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check-list">
                                            <div class="radio radio-success radio-outlined">
                                                <input type="radio" id="exampleRadioColorStyledOutlinedSuccess" name="colorOutlineStyleRadio2">
                                                <label for="exampleRadioColorStyledOutlinedSuccess">Style Success</label>
                                            </div>
                                            <div class="radio radio-warning radio-outlined">
                                                <input type="radio" id="exampleRadioColorStyledOutlinedWarning" name="colorOutlineStyleRadio2">
                                                <label for="exampleRadioColorStyledOutlinedWarning">Style Warning</label>
                                            </div>
                                            <div class="radio radio-danger radio-outlined">
                                                <input type="radio" id="exampleRadioColorStyledOutlinedDanger" name="colorOutlineStyleRadio2">
                                                <label for="exampleRadioColorStyledOutlinedDanger">Style Danger</label>
                                            </div>
                                            <hr>
                                            <div class="radio radio-warning radio-outlined bw-2">
                                                <input type="radio" id="exampleRadioColorStyledOutlinedWarningBw" name="colorOutlineStyleRadio2">
                                                <label for="exampleRadioColorStyledOutlinedWarningBw">Border 2x</label>
                                            </div>
                                            <div class="radio radio-danger radio-outlined bw-2">
                                                <input type="radio" id="exampleRadioColorStyledOutlinedDangerBw" name="colorOutlineStyleRadio2">
                                                <label for="exampleRadioColorStyledOutlinedDangerBw">Border 2x</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- Text Addons -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Input Groups</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="form cozy">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Left text addon</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" placeholder="Left addon">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Left addon multiple</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <span class="input-group-text">0.00</span>
                                    <input type="text" class="form-control" placeholder="Multiple left addon">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Right text addon</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Right addon">
                                    <span class="input-group-text">@example.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Right addon multiple</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Multiple right addon">
                                    <span class="input-group-text">$</span>
                                    <span class="input-group-text">0.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Left and Right addons</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" placeholder="Multiple right addon">
                                    <span class="input-group-text">0.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">With textarea</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-text">Comments</span>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Icons Addons -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Icons Addon</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="form cozy">
                        <fieldset class="mb-3">
                            <legend class="small bold text-uppercase text-primary">Static Icons</legend>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left icon addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Left icon addon">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left icon + text</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-text">Options</span>
                                        <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                        <input type="text" class="form-control" placeholder="Multiple left icon addon">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Right icon addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Right addon">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Right icon + text</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Multiple right icon addon">
                                        <span class="input-group-text">Options</span>
                                        <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left and Right addons</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Multiple right icon addon">
                                        <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-3">
                            <legend class="small bold text-uppercase text-primary">Animated Icons</legend>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left icon addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-sync fa-spin"></i></span>
                                        <input type="text" class="form-control" placeholder="Left icon addon">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Right icon addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Right addon">
                                        <span class="input-group-text"><i class="fas fa-spinner fa-pulse"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left and Right addons</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-sync fa-spin"></i></span>
                                        <input type="text" class="form-control" placeholder="Multiple right icon addon">
                                        <span class="input-group-text"><i class="fas fa-cog fa-spin"></i></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <!-- Dropdowns Addons -->
            <div class="card card-clean mb-4 shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Dropdown Addons</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="form cozy">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Left dropdown addon</label>
                            <div class="col-lg-9">
                                <div class="input-group clean-group">
                                    <button class="btn btn-contrast dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Left addon">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Right dropdown addon</label>
                            <div class="col-lg-9">
                                <div class="input-group clean-group">
                                    <input type="text" class="form-control" placeholder="Right addon">
                                    <button class="btn btn-contrast dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Left and right dropdown addon</label>
                            <div class="col-lg-9">
                                <div class="input-group clean-group">
                                    <button class="btn btn-contrast dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>

                                    <input type="text" class="form-control" placeholder="Left and right addon">

                                    <button class="btn btn-contrast dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Button Addons -->
            <div class="card card-clean shadow-box">
                <div class="card-header bg-contrast">
                    <h5 class="bold">Button Addons</h5>
                </div>

                <div class="card-body">
                    <form action=";" class="form cozy">
                        <fieldset class="mb-3">
                            <legend class="small bold text-uppercase text-primary">Clean group</legend>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left text addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group clean-group">
                                        <button class="btn btn-contrast" type="button">Button</button>
                                        <input type="text" class="form-control" placeholder="Left addon">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Right text addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group clean-group">
                                        <input type="text" class="form-control" placeholder="Right addon">
                                        <button class="btn btn-contrast" type="button">Button</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left and Right addons</label>
                                <div class="col-lg-9">
                                    <div class="input-group clean-group">
                                        <button class="btn btn-contrast" type="button">Button</button>
                                        <input type="text" class="form-control" placeholder="Multiple right addon">
                                        <button class="btn btn-contrast" type="button">Button</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-3">
                            <legend class="small bold text-uppercase text-primary">Colored buttons</legend>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left text addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <button class="btn btn-primary" type="button">Button</button>
                                        <input type="text" class="form-control" placeholder="Left addon">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Right text addon</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Right addon">
                                        <button class="btn btn-warning" type="button">Button</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Left and Right addons</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <button class="btn btn-primary" type="button">Button</button>
                                        <input type="text" class="form-control" placeholder="Multiple right addon">
                                        <button class="btn btn-danger" type="button">Button</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
