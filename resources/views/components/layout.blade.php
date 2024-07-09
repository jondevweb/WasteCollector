<form onSubmit="login()" method="post">
                        @csrf
                        <div class="form-row align-items-center" style="display:flex; flex-direction: column;">
                            <div class="card" style="width: 25rem; margin: 20px auto;">
                                <div class="col-auto">
                                    <label class="sr-only" for="email">Courriel</label>
                                    <div class="input-group mb-2" style="border-bottom: 1px solid gray;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="border: none; background: white;">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Courriel">
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="width: 25rem; margin: 20px auto;">
                                <div class="col-auto">
                                    <label class="sr-only" for="password">Mot de passe</label>
                                    <div class="input-group mb-2" style="border-bottom: 1px solid gray;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="border: none; background: white;">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe"  aria-describedby="passwordHelpInline">
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="width: 25rem; margin: 20px auto;">
                                {{ $slot }}
                            </div>
                            <div class="card" style="width: 25rem; margin: 20px auto;">
                                <div class="col-auto" style="padding: 0px">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>