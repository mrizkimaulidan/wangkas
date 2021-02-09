<div class="modal fade" id="editCashTransactionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Kas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="cash-transaction-edit-form">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Pelajar</label>
                                <select class="form-select" name="student_id" id="student_id">
                                    <option selected>Pilih pelajar</option>
                                    @foreach ($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->student_identification_number }} - {{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bill" class="form-label">Tagihan</label>
                                <input type="number" class="form-control" name="bill" value="{{ config('app.bill') }}"
                                    id="bill" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Total Bayar</label>
                                <input type="number" class="form-control" name="amount" id="amount"
                                    placeholder="Masukkan total bayar..">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Status Pembayaran</label>
                                <select class="form-select" name="is_paid" id="is_paid">
                                    <option selected>Pilih status pembayaran</option>
                                    <option value="1">Lunas</option>
                                    <option value="0">Belum Lunas</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="date" id="date"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="note" class="form-label">Catatan</label>
                            <textarea class="form-control" name="note" id="note" rows="3"
                                placeholder="Masukkan catatan (opsional).."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>