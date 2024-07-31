    <!-- Optional JavaScript; choose one of the two! -->

            <div class="form-group">
                <label for="carrera">Carrera</label>
                <input
                    value="{{$perfil->carrera}}"
                    type="text"
                    class="form-control"
                    name="carrera"
                    id="carrera"
                    aria-describedby="helpId"
                    placeholder=""
                />
                <small id="helpId" class="form-text text-muted">Carrera</small>
            </div>

            <div class="form-group">
                <label for="tags">tags</label>
                <input
                    type="text"
                    class="form-control"
                    data-role="tagsinput"
                    name="tags"
                    id="tags"
                    aria-describedby="helpId"
                    placeholder=""
                    value="{{$tags}}"
                />
                <small id="helpId" class="form-text text-muted">tags</small>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
