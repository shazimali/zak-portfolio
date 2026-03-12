<div class="dj-story-wrapper">

    {{-- ── VIEW MODE ── --}}
    @if(! $editing)
        <p class="story-text _4">{!! $storyText !!}</p>

        @auth
            @if(auth()->user()->is_admin)
                <button wire:click="startEditing" class="dj-story-edit-btn" title="Edit text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </button>

                @if(session()->has('story_updated'))
                    <div class="dj-story-toast">✓ Text updated</div>
                @endif
            @endif
        @endauth

    {{-- ── EDIT MODE ── --}}
    @else
        <div class="dj-story-editor" x-data="storyEditor(@js($editText))">

            {{-- Toolbar --}}
            <div class="dj-rte-toolbar">
                <button type="button" @click="exec('bold')"
                    :class="{ 'active': isActive('bold') }"
                    class="dj-rte-btn" title="Bold">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/><path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/>
                    </svg>
                </button>

                <button type="button" @click="exec('italic')"
                    :class="{ 'active': isActive('italic') }"
                    class="dj-rte-btn" title="Italic">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="19" y1="4" x2="10" y2="4"/><line x1="14" y1="20" x2="5" y2="20"/>
                        <line x1="15" y1="4" x2="9" y2="20"/>
                    </svg>
                </button>

                <div class="dj-rte-divider"></div>

                <button type="button" @click="openLinkDialog()"
                    :class="{ 'active': isActive('createLink') }"
                    class="dj-rte-btn" title="Add link">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                    </svg>
                </button>

                <button type="button" @click="removeLink()"
                    class="dj-rte-btn" title="Remove link">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                        <line x1="2" y1="2" x2="22" y2="22" stroke-width="2"/>
                    </svg>
                </button>

                <div class="dj-rte-divider"></div>

                <button type="button" @click="resetToDefault()"
                    class="dj-rte-btn dj-rte-btn-reset" title="Reset to default">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="1 4 1 10 7 10"/>
                        <path d="M3.51 15a9 9 0 1 0 .49-3.34"/>
                    </svg>
                </button>
            </div>

            {{-- Link dialog --}}
            <div x-show="showLinkDialog" x-cloak class="dj-link-dialog">
                <input
                    x-ref="linkInput"
                    type="url"
                    x-model="linkUrl"
                    placeholder="https://example.com"
                    class="dj-field-input"
                    @keydown.enter.prevent="applyLink()"
                    @keydown.escape="showLinkDialog = false"
                />
                <div class="dj-link-dialog-actions">
                    <button type="button" @click="applyLink()" class="dj-btn-save" style="padding: 7px 16px; flex: unset;">Apply</button>
                    <button type="button" @click="showLinkDialog = false" class="dj-btn-cancel" style="padding: 7px 16px; flex: unset;">Cancel</button>
                </div>
            </div>

            {{-- Contenteditable area --}}
            <div
                x-ref="editor"
                contenteditable="true"
                class="dj-rte-content"
                x-html="content"
                @input="content = $el.innerHTML"
                @mouseup="updateActiveStates()"
                @keyup="updateActiveStates()"
            ></div>

            {{-- Live preview --}}
            <div class="dj-story-preview">
                <p class="story-text _4" style="margin:0;" x-html="content || '...'"></p>
            </div>

            <div class="dj-story-actions">
                <button type="button" @click="saveContent()" class="dj-btn-save">Save</button>
                <button type="button" wire:click="cancel" class="dj-btn-cancel">Cancel</button>
            </div>

        </div>
    @endif

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('storyEditor', (initialContent) => ({
            content: initialContent,
            showLinkDialog: false,
            linkUrl: '',
            savedRange: null,
            boldActive: false,
            italicActive: false,

            exec(cmd, value = null) {
                this.$refs.editor.focus();
                document.execCommand(cmd, false, value);
                this.content = this.$refs.editor.innerHTML;
                this.updateActiveStates();
            },

            isActive(cmd) {
                return document.queryCommandState(cmd);
            },

            updateActiveStates() {
                this.boldActive   = document.queryCommandState('bold');
                this.italicActive = document.queryCommandState('italic');
            },

            openLinkDialog() {
                // Save current selection so we can apply link after dialog input
                const sel = window.getSelection();
                if (sel && sel.rangeCount > 0) {
                    this.savedRange = sel.getRangeAt(0).cloneRange();
                }
                this.linkUrl = '';
                this.showLinkDialog = true;
                this.$nextTick(() => this.$refs.linkInput.focus());
            },

            applyLink() {
                if (! this.linkUrl) return;
                // Restore saved selection
                if (this.savedRange) {
                    const sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(this.savedRange);
                }
                this.$refs.editor.focus();
                document.execCommand('createLink', false, this.linkUrl);
                // Add target + class to newly created link
                this.$refs.editor.querySelectorAll('a').forEach(a => {
                    a.setAttribute('target', '_blank');
                    a.setAttribute('rel', 'noopener noreferrer');
                    if (! a.classList.contains('link')) a.classList.add('link');
                });
                this.content = this.$refs.editor.innerHTML;
                this.showLinkDialog = false;
                this.savedRange = null;
            },

            removeLink() {
                this.$refs.editor.focus();
                document.execCommand('unlink', false, null);
                this.content = this.$refs.editor.innerHTML;
            },

            resetToDefault() {
                if (confirm('Reset to original default text?')) {
                    this.content = @js(\App\Livewire\EditableStoryText::DEFAULT_TEXT);
                    this.$refs.editor.innerHTML = this.content;
                }
            },

            saveContent() {
                @this.save(this.content);
            },
        }));
    });
</script>

<style>
    .dj-story-wrapper { position: relative; }

    @auth
        @if(auth()->user()->is_admin)
            .dj-story-wrapper:hover > .story-text {
                outline: 2px solid #3b82f6;
                outline-offset: 4px;
                border-radius: 4px;
            }
        @endif
    @endauth

    .dj-story-edit-btn {
        position: absolute;
        top: -12px; right: -12px;
        background: #3b82f6; border: none; border-radius: 50%;
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: white;
        opacity: 0; transform: scale(0.8);
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15); padding: 0;
    }
    .dj-story-wrapper:hover .dj-story-edit-btn { opacity: 1; transform: scale(1); }
    .dj-story-edit-btn:hover { background: #2563eb; transform: scale(1.1) !important; }

    .dj-story-toast {
        position: absolute; top: -32px; left: 0;
        background: #22c55e; color: white;
        padding: 3px 10px; border-radius: 4px;
        font-size: 12px; font-weight: 500; white-space: nowrap;
        z-index: 9999; animation: dj-story-fade 2.5s ease forwards;
    }
    @keyframes dj-story-fade { 0%,60%{opacity:1} 100%{opacity:0} }

    /* Editor */
    .dj-story-editor {
        background: white; border: 1.5px solid #e2e8f0;
        border-radius: 12px; padding: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        display: flex; flex-direction: column; gap: 12px;
    }

    /* Toolbar */
    .dj-rte-toolbar {
        display: flex; align-items: center; gap: 4px;
        background: #f8fafc; border: 1px solid #e2e8f0;
        border-radius: 8px; padding: 6px 8px;
    }
    .dj-rte-btn {
        background: none; border: none;
        border-radius: 6px; width: 30px; height: 30px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #475569;
        transition: all 0.15s;
    }
    .dj-rte-btn:hover { background: #e2e8f0; color: #1e293b; }
    .dj-rte-btn.active { background: #3b82f6; color: white; }
    .dj-rte-btn-reset { color: #94a3b8; margin-left: auto; }
    .dj-rte-btn-reset:hover { color: #ef4444; background: #fee2e2; }
    .dj-rte-divider { width: 1px; height: 20px; background: #e2e8f0; margin: 0 4px; }

    /* Link dialog */
    .dj-link-dialog {
        background: #f8fafc; border: 1.5px solid #e2e8f0;
        border-radius: 8px; padding: 10px;
        display: flex; gap: 8px; align-items: center; flex-wrap: wrap;
    }
    .dj-link-dialog .dj-field-input { flex: 1; min-width: 200px; }
    .dj-link-dialog-actions { display: flex; gap: 6px; }

    /* Editable content area */
    .dj-rte-content {
        min-height: 100px; padding: 12px;
        border: 1.5px solid #e2e8f0; border-radius: 8px;
        font-size: 14px; color: #1e293b; line-height: 1.7;
        outline: none; font-family: inherit;
    }
    .dj-rte-content:focus { border-color: #3b82f6; }
    .dj-rte-content a { color: #3b82f6; text-decoration: underline; }

    /* Preview */
    .dj-story-preview {
        background: #f8fafc; border-radius: 8px;
        padding: 14px; border: 1px dashed #cbd5e1;
    }

    /* Fields */
    .dj-field-input {
        width: 100%; padding: 8px 12px;
        border: 1.5px solid #e2e8f0; border-radius: 8px;
        font-size: 14px; color: #1e293b; outline: none;
        transition: border-color 0.15s; box-sizing: border-box;
    }
    .dj-field-input:focus { border-color: #3b82f6; }

    /* Actions */
    .dj-story-actions { display: flex; gap: 8px; }
    .dj-btn-save {
        flex: 1; padding: 9px 0;
        background: #3b82f6; color: white; border: none;
        border-radius: 8px; font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background 0.15s;
    }
    .dj-btn-save:hover { background: #2563eb; }
    .dj-btn-cancel {
        flex: 1; padding: 9px 0;
        background: #f1f5f9; color: #64748b; border: none;
        border-radius: 8px; font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background 0.15s;
    }
    .dj-btn-cancel:hover { background: #e2e8f0; }

    [x-cloak] { display: none !important; }
</style>